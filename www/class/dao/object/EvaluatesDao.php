<?php

namespace dao\object;

use model\Evaluates;

interface EvaluatesDao {
    function create(Evaluates $evaluates): bool;
    function find(String $idClient): Evaluates;
    function update(Evaluates $evaluates): bool;

}