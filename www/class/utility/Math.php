<?php


namespace utility;


class Math
{
    public static function getAverage(array $numbers):float{
        $sum = 0;
        foreach ($numbers as $number){
            $sum += $number;
        }
        return $sum/count($numbers);
    }

    public static function getVariance(array $numbers):float{
        $sum = 0;
        $average = Math::getAverage($numbers);
        foreach ($numbers as $number){
            $sum += pow( ($number-$average), 2);
        }

        return $sum/count($numbers);
    }

    //Ecart type
    public static function getStandardDeviation(array $numbers):float{
        return sqrt(Math::getVariance($numbers));
    }

    public static function getAbsoluteDifference(array $numbers):float{
        $sum = 0;
        $average = Math::getAverage($numbers);
        foreach ($numbers as $number){
            $sum += abs($number-$average);
        }
        return $sum/count($numbers);
    }

    public static function nearestFigure(int $figure, array $numbers, int $number=1):array{
        $nearestFigures = array();
        $numbers = array_unique($numbers) ;
        sort($numbers);
        while($number>0) {
            $nearestNumber = $numbers[0];
            $indexNearest = 0;
            //var_dump($numbers);
            for ($i = 1; $i < count($numbers); $i++) {
                if (abs($numbers[$i] - $figure) < abs($nearestNumber - $figure)) {
                    $nearestNumber = $numbers[$i];
                    $indexNearest = $i;
                }
            }
            array_push($nearestFigures,$nearestNumber);
            unset($numbers[$indexNearest]);
            sort($numbers);
            $number--;
        }
        return $nearestFigures;
    }

}