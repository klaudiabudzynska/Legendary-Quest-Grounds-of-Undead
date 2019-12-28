<?php


namespace App\Service;


class GameService
{

    public function boardGenerate(){
        $length = 32;
        $tab = [];


        for($i = 0; $i < $length; $i++){
            for ($j = 0; $j < $length; $j++){

                if(($i == 0 || $i == ($length - 1)) && ( $j == 0 || $j == ($length - 1))){
                    $tab[$i][$j] = "S";
                    continue;
                }
                else if((($i == 0 || $i == ($length - 1)) && ($j > 0 && $j < $length )) || (($j == 0 || $j == ($length - 1)) && ($i > 0 && $i < $length - 1))){
                    $tab[$i][$j] = "P";
                    continue;
                }
                $tab[$i][$j] = 'M';

            }
        }

        return $tab;
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

}