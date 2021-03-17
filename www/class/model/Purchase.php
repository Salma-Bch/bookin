<?php


namespace model;


class Purchase {

    private int $clientId;
    private int $bookId;
    private float $amount;
    private int $quantity;

    /**
     * Purchase constructor.
     * @param int $clientId
     * @param int $bookId
     * @param float $amount
     * @param int $quantity
     */
    public function __construct(int $clientId, int $bookId, float $amount, int $quantity)
    {
        $this->clientId = $clientId;
        $this->bookId = $bookId;
        $this->amount = $amount;
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param int $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return int
     */
    public function getBookId()
    {
        return $this->bookId;
    }

    /**
     * @param int $bookId
     */
    public function setBookId($bookId)
    {
        $this->bookId = $bookId;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }
}