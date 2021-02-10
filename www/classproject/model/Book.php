<?php


namespace model;


class Book {
    private int $bookId;
    private String $title;
    private String $author;
    private String $ageRange;
    private int $numberPages;
    private float $price;
    private int $quantity;
    private \Imagick $bookImage;
    private String $categoryName;

    /**
     * Book constructor.
     * @param int $bookId
     * @param String $title
     * @param String $author
     * @param String $ageRange
     * @param int $numberPages
     * @param float $price
     * @param int $quantity
     * @param \Imagick $bookImage
     */
    public function __construct(int $bookId, string $title, string $author, string $ageRange, int $numberPages, float $price, int $quantity, \Imagick $bookImage, String $categoryName)
    {
        $this->bookId = $bookId;
        $this->title = $title;
        $this->author = $author;
        $this->ageRange = $ageRange;
        $this->numberPages = $numberPages;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->bookImage = $bookImage;
        $this->categoryName = $categoryName;
    }


    /**
     * @return int
     */
    public function getBookId(): int
    {
        return $this->bookId;
    }

    /**
     * @param int $bookId
     */
    public function setBookId(int $bookId): void
    {
        $this->bookId = $bookId;
    }

    /**
     * @return String
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param String $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return String
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param String $author
     */
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    /**
     * @return String
     */
    public function getAgeRange(): string
    {
        return $this->ageRange;
    }

    /**
     * @param String $ageRange
     */
    public function setAgeRange(string $ageRange): void
    {
        $this->ageRange = $ageRange;
    }

    /**
     * @return int
     */
    public function getNumberPages(): int
    {
        return $this->numberPages;
    }

    /**
     * @param int $numberPages
     */
    public function setNumberPages(int $numberPages): void
    {
        $this->numberPages = $numberPages;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
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
     * @return \Imagick
     */
    public function getBookImage(): \Imagick
    {
        return $this->bookImage;
    }

    /**
     * @param \Imagick $bookImage
     */
    public function setBookImage(\Imagick $bookImage): void
    {
        $this->bookImage = $bookImage;
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