<?php

namespace dao\object;

use model\Evaluates;

interface EvaluatesDao {
    function create(Evaluates $evaluates): bool;
    function find(String $bookId, String $clientId): array ;
    function update(Evaluates $evaluates): bool;
}