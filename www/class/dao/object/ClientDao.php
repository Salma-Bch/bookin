<?php

namespace dao\object;

use model\Client;

interface ClientDao {
    function create(Client $client): bool;
    function find(String $mail, String $password): Client;
    function update(Client $client): bool;

}