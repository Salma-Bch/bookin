<?php


namespace dao;


use model\Client;

interface ClientDao {
    function create(Client $client): bool;
    function find(String $clientId): Client;
    function update(Client $client): bool;

}