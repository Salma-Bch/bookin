<?php


namespace model;


class Category {
    private String $categoryName;

    /**
     * Category constructor.
     * @param String $categoryName
     */
    public function __construct(string $categoryName)
    {
        $this->categoryName = $categoryName;
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