<?php


namespace dao\object;


use model\Purchase;

interface PurchaseDao {
    function create(Purchase $purchase): bool;
    function getClientPurchases(int $clientId): array;
    function find(int $clientId, int $bookId): ?Purchase;
    function update(Purchase $purchase): bool;
}