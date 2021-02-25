<?php


namespace controller;


use model\Client;
use utility\Math;

class ContentTypeModelling
{
    private Client $client;
    private array $likedBooks;
    private array $purchase;

    /**
     * ContentTypeModelling constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getCategoryModel():String{
        return "riiiiennn";
    }

    public function getAgeRangeModel():String{
        return "riiiiennn";
    }

    public function getPriceModel():array{
        $numbers = array(50,56,61,68,51,53,69,68);
        $average = Math::getAverage($numbers);
        $absoluteDifference = Math::getAbsoluteDifference($numbers);
        return array($average - $absoluteDifference, $average + $absoluteDifference);
    }


}