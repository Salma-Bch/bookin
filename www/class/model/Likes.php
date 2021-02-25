<?php


namespace model;


class Likes {
    private int $clientId;
    private String $categoryName;

    /**
     * Book constructor.
     * @param int $clientId
     * @param String $categoryName
     */
    public function __construct(int $clientId, string $categoryName)
    {
        $this->clientId = $clientId;
        $this->categoryName = $categoryName;
    }

    public function toArray(): array{
        return array(str_pad(($this->bookId),2,0, STR_PAD_LEFT),
            $this->clientId,
            $this->categoryName);
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
    public function setClientId(int $clientId): void
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

}