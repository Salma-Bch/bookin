<?php


namespace model;

use utility\Format;


class Book {
    private int $bookId;
    private String $title;
    private String $author;
    private String $ageRange;
    private int $numberPages;
    private float $price;
    private int $quantity;
    private String $imagePath;
    private array $tags;
    private String $categoryName;

    private const COURT = 100;
    private const MOYEN = 200;
    private const LONG = 300;

    /**
     * Book constructor.
     * @param int $bookId
     * @param String $title
     * @param String $author
     * @param String $ageRange
     * @param int $numberPages
     * @param float $price
     * @param int $quantity
     * @param String $imagePath
     * @param array $tags
     * @param String $categoryName
     */
    public function __construct(int $bookId, string $title, string $author, string $ageRange, int $numberPages, float $price, int $quantity, String $imagePath, array $tags, String $categoryName)
    {
        $this->bookId = $bookId;
        $this->title = $title;
        $this->author = $author;
        $this->ageRange = $ageRange;
        $this->numberPages = $numberPages;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->imagePath = $imagePath;
        $this->tags = $tags;
        $this->categoryName = $categoryName;
    }

    public function toArray(bool $bookIdLast=false): array{
        if($bookIdLast)
            $bookArray = array(
                $this->title,
                $this->author,
                $this->ageRange,
                $this->numberPages,
                $this->price,
                $this->quantity,
                $this->imagePath,
                implode(",",$this->tags),
                $this->categoryName,
                Format::getFormatId(8,$this->bookId));
        else
            $bookArray = array(Format::getFormatId(8,$this->bookId),
                $this->title,
                $this->author,
                $this->ageRange,
                $this->numberPages,
                $this->price,
                $this->quantity,
                $this->imagePath,
                implode(",",$this->tags),
                $this->categoryName);
        return $bookArray;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     */
    public function setTags(array $tags): void
    {
        $this->tags = $tags;
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

    public function getBookSize():String{
        $numberOfPage = $this->getNumberOfPages();
        if($numberOfPage <= self::COURT)
            return "court";
        else if($numberOfPage <= self::MOYEN)
            return "moyen";
        else
            return "long";
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
     * @return String
     */
    public function getImagePath(): String
    {
        return $this->imagePath;
    }

    /**
     * @param String $imagePath
     */
    public function setImagePath(String $imagePath): void
    {
        $this->imagePath = $imagePath;
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