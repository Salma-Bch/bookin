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
}