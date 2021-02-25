<?php


namespace controller;


use model\Client;

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

    public function getPriceModel():float{
        return "riiiiennn";
    }

}