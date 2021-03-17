<?php


namespace model;


use utility\Format;

class Evaluates {
    private int $clientId;
    private int $bookId;
    private bool $satisfied;

    /**
     * Book constructor.
     * @param int $clientId
     * @param string $bookId
     * @param bool $satisfied
     */
    public function __construct(int $clientId, int $bookId, bool $satisfied)
    {
        $this->clientId = $clientId;
        $this->bookId = $bookId;
        $this->satisfied = $satisfied;
    }

    public function toArray(): array{
        return array(
            Format::getFormatId(8,$this->clientId),
            Format::getFormatId(8,$this->bookId),
            $this->satisfied);
    }

    /**
     * @return int
     */
    public function getClientId(): int
    {
        return $this->clientId;
    }

    /**
     * @param int $clientId
     */
    public function setClientId(string $clientId): void
    {
        $this->clientId = $clientId;
    }

    /**
     * @return String
     */
    public function getBookId(): int
    {
        return $this->bookId;
    }

    /**
     * @param string $bookId
     */
    public function setBookId(int $bookId): void
    {
        $this->bookId = $bookId;
    }

    /**
     * @return bool
     */
    public function getSatisfied(): bool
    {
        return $this->satisfied;
    }

    /**
     * @param bool $satisfied
     */
    public function setSatisfied(bool $satisfied): void
    {
        $this->satisfied = $satisfied;
    }

}