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

    public function getPriceModel(array $prices):float{
        if(count($prices)>=6 && Math::getStandardDeviation($prices)<30) {
            return Math::getAverage($prices);
        }
        else
            return -1;
    }


}