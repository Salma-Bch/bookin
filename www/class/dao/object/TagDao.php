<?php

namespace dao\object;

use model\Tag;

interface TagDao {
    function create(Tag $tag): bool;
    function find(String $tag_name, String $id_book): array;
    function update(Tag $tag): bool;
}