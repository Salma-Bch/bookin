<?php


namespace model;


class Likes {
    private String $clientId;
    private String $categoryName;

    /**
     * Book constructor.
     * @param String $clientId
     * @param String $categoryName
     */
    public function __construct(string $clientId, string $categoryName)
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
     * @return String
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @param String $clientId
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

}