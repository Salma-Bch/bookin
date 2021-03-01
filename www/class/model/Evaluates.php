<?php


namespace model;


class Evaluates {
    private int $clientId;
    private String $categoryName;
    private bool $satisfied;

    /**
     * Book constructor.
     * @param int $clientId
     * @param String $categoryName
     * @param bool $satisfied
     */
    public function __construct(int $clientId, string $categoryName, bool $satisfied)
    {
        $this->clientId = $clientId;
        $this->categoryName = $categoryName;
        $this->satisfied = $satisfied;
    }

    public function toArray(): array{
        return array(str_pad(($this->bookId),3,0, STR_PAD_LEFT),
            $this->clientId,
            $this->categoryName,
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
    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    /**
     * @param String $categoryName
     */
    public function setCategoryName(string $categoryName): void
    {
        $this->categoryName = $categoryName;
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