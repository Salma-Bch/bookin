<?php


namespace dao\object;


use model\Purchase;

interface PurchaseDao {
    function create(Purchase $purchase): bool;
    /*function find(int $clientId): Purchase;*/
    function getClientPurchases(int $clientId): array;
    function update(Purchase $purchase): bool;
}