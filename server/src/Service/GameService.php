<?php


namespace App\Service;


use App\Entity\GameElements;
use App\Repository\GameElementsRepository;

class GameService
{

    /**
     * @var GameElementsRepository
     */
    private $gameElementsRepository;

    public function __construct(GameElementsRepository $gameElementsRepository)
    {
        $this->gameElementsRepository = $gameElementsRepository;
    }

    public function boardGenerate(){
        $length = 32;
        $tab = [];
        $json = [];

        $elements = $this->gameElementsRepository->findAll();


        /** @var GameElements $pole */
        $pole = $this->gameElementsRepository->findOneBy(["name" => "Pole"]);
        [$coords, $board] = $this->loadBarrier($tab, $pole, $length);
        $pole->setCoordinates($coords);
        array_push($json, $pole);

        /** @var GameElements $fence */
        $fence = $this->gameElementsRepository->findOneBy(["name" => "Fence"]);
        [$coords, $board] = $this->loadBarrier($tab, $fence, $length);
        $fence->setCoordinates($coords);
        array_push($json, $fence);

        /** @var GameElements $church */
        $church = $this->gameElementsRepository->findOneBy(["name" => "Church"]);
        [$coords, $board] = $this->loadChurch($tab, $church, $length);
        $church->setCoordinates($coords);
        array_push($json, $church);

        /** @var GameElements $path */
        $path = $this->gameElementsRepository->findOneBy(["name" => "Path"]);
        [$coords, $board] = $this->loadGround($tab, $path, $length);
        $path->setCoordinates($coords);
        array_push($json, $path);

        /** @var GameElements $swamp */
        $swamp = $this->gameElementsRepository->findOneBy(["name" => "Swamp"]);
        [$coords, $board] = $this->loadGround($tab, $swamp, $length);
        $swamp->setCoordinates($coords);
        array_push($json, $swamp);

        $this->emptyArray($tab);
        return [$json,$tab];

    }

    public function displayBoard(array $tab){
        $k = "";
        for ($i = 0; $i < count($tab); $i++ ){
            for ($j = 0; $j < count($tab); $j++){

                switch ($tab[$i][$j]){
                    case 'P':
                        $k .= "<div style='background-color: gray; font-family: monospace; display: inline-block; height: 14px; width: 14px;'>P</div>";
                        break;
                    case 'F':
                        $k .= "<div style='background-color: brown; font-family: monospace; display: inline-block;  height: 14px; width: 14px;'>F </div>";
                        break;
                    case 'C':
                        $k .= "<div style='background-color: red; font-family: monospace; display: inline-block; height: 14px; width: 14px;'>C </div>";
                        break;
                    case 'H':
                        $k .= "<div style='background-color: darkgreen; font-family: monospace; display: inline-block; height: 14px; width: 14px;'>H </div>";
                        break;
                    case 'S':
                        $k .= "<div style='background-color: darkseagreen; display: inline-block; font-family: monospace; height: 14px; width: 14px;'>S </div>";
                        break;
                }
            }

            $k .= "<br/>";
        }

        return $k;
    }

    private function loadBarrier(array &$tab, GameElements $element, int $length)
    {
        $coords = [];
        if($element->getType() == -1){
            $tab[0][0] = "P";
            $tab[$length - 1][0] = "P";
            $tab[0][$length - 1] = "P";
            $tab[$length - 1][$length - 1] = "P";

            $coords = ["0;0", "0;".($length - 1), ($length - 1).";0", ($length - 1).";".($length - 1)];
        }
        else{
            for($i = 1; $i < $length - 2; $i+=$element->getWidth()){
                if($i >= $length - 2) continue;
                for($j = $i; $j < $i + $element->getWidth(); $j++){
                    $tab[0][$j] = "F";
                    $tab[$length - 1][$j] = "F";
                    $tab[$j][0] = "F";
                    $tab[$j][$length - 1] = "F";
                }

                $coords[] = "0;{$i}";
                $coords[] = "{$j};0";
                $coords[] = ($length-2).";{$j}";
                $coords[] = "{$j};".($length - 1);
            }
        }
        return [$coords, $tab];
    }

    private function loadGround(array &$tab, GameElements $element, int $length): array
    {
        $angle = rand(($length - 2) / 2, ($length - 1) );
        $arg = rand(1, 1000) % 2 == 0 ? "X" : "Y";
        $coords = [];
        if($element->getName() == "Path")
        {
            $k = $angle;
            for($i = $length - 1; $i > 0; $i--){
                for ($j = 1; $j < $k; $j++){
                    if($arg == "X"){
                        if(isset($tab[$i][$j])) continue;
                        $tab[$i][$j] = "H";
                        $coords[] = "{$i};{$j}";
                    }
                    else{
                        if(isset($tab[$j][$i])) continue;
                        $tab[$j][$i] = "H";
                        $coords[] = "{$j};{$i}";
                    }

                }

                if($k > 0 && $k < $length - 3) $k--;
            }
        }
        else{
            for ($i = 0; $i < $length; $i++){
                for($j = 0; $j < $length; $j++){
                    if(isset($tab[$i][$j])) continue;
                    $tab[$i][$j] = "S";
                    $coords[] = "{$i};{$j}";
                }
            }
        }

        return [$coords, $tab];
    }

    private function loadChurch(array &$tab, GameElements $church, int $length): array
    {
        $x = rand(1, $length - 2 - $church->getWidth());
        $y = rand(1, $length - 2 - $church->getHeight());

        $coords = ["{$x};{$y}"];

        for ($i = $y; $i < $y + $church->getHeight(); $i++){
            for ($j = $x; $j < $x + $church->getWidth(); $j++){

                    $tab[$i][$j] = "C";
            }
        }

        return [$coords, $tab];
    }

    private function emptyArray(array &$tab){
        for ($i = 1; $i < count($tab) - 1; $i++){
            for ($j = 1; $j < count($tab) - 1; $j++){
                if(isset($tab[$i][$j])) continue;

                $tab[$i][$j] = "-";
            }
        }
    }
}