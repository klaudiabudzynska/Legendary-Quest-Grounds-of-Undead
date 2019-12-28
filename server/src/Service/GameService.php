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

        /** @var GameElements $fence */
        $fence = $this->gameElementsRepository->findOneBy(["name" => "Fence"]);


        /** @var GameElements $element */
        foreach ($elements as $element){

            [$coords, $board] = $this->calcCoordinates($tab, $element, $length);
           $element->setCoordinates($coords);
           array_push($json, $element);
       }
        return [$json, $tab];
    }

    public function displayBoard(array $tab){
        $k = "";
        for ($i = 0; $i < count($tab); $i++ ){
            for ($j = 0; $j < count($tab); $j++){
               $k .= $tab[$i][$j]." ";
            }

            $k .= "<br/>";
        }

        return $k;
    }

    private function calcCoordinates(array &$tab, GameElements $element, int $length): array
    {
        $coords = [];
        if($element->getType() < 0){
            [$coords, $tab] = $this->loadBarrier($tab, $element, $length);
            return [$coords, $tab];
        }
        else if($element->isCanMove() && $element->getName() == "Path"){
            for($i = 1; $i < $length - 1; $i++){
                for($j = 1; $j < $length - 1; $j++){
                    $coords[] = "{$i};{$j}";
                    $tab[$i][$j] = "M";
                }
            }
            return [$coords, $tab];
        }
        else return [[],[]];
    }

    private function loadBarrier(array &$tab, GameElements $element, int $length)
    {
        $coords = [];
        if($element->getType() == -1){
            $tab[0][0] = "S";
            $tab[$length - 1][0] = "S";
            $tab[0][$length - 1] = "S";
            $tab[$length - 1][$length - 1] = "S";

            $coords = ["0;0", "0;".($length - 1), ($length - 1).";0", ($length - 1).";".($length - 1)];

            return [$coords, $tab];
        }
        else{
            for($i = 1; $i < $length - 2; $i+=$element->getWidth()){
                if($i >= $length - 2) continue;
                for($j = $i; $j < $i + $element->getWidth(); $j++){
                    $tab[0][$j] = "P";
                    $tab[$length - 1][$j] = "P";
                    $tab[$j][0] = "P";
                    $tab[$j][$length - 1] = "P";
                }

                $coords[] = "0;{$i}";
                $coords[] = "{$j};0";
                $coords[] = ($length-2).";{$j}";
                $coords[] = "{$j};".($length - 1);
            }

            return [$coords, $tab];
        }


    }


}