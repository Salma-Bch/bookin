<?php

namespace dao\object;

use model\Likes;

interface LikesDao {
    function create(Likes $likes): bool;
    function getClientLikes(int $clientId): array;
    // function find(String $id_client): Likes;
    function update(Likes $likes): bool;
}