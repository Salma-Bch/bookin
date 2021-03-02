<?php

namespace dao\object;

use model\Likes;

interface LikesDao {
    function create(Likes $likes): bool;
    function find(String $id_client, String $category_name): array;
    function update(Likes $likes): bool;
}