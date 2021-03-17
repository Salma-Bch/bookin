<?php


namespace model;


use http\Encoding\Stream;

class Tag {

    private String $tagName;
    private String $booksId;

    /**
     * Purchase constructor.
     * @param $tagName
     * @param int $bookId
     */
    public function __construct(String $tagName, String $booksId)
    {
        $this->tagName = $tagName;
        $this->booksId = $booksId;
    }

    public function toArray(){
        return array(
            $this->tagName,
            $this->booksId
        );
    }
    /**
     * @return String
     */
    public function getTagName():String
    {
        return $this->tagName;
    }

    /**
     * @param String $tagName
     */
    public function setTagName(String $tagName):void
    {
        $this->tagName = $tagName;
    }

    /**
     * @return int
     */
    public function getBooksId():String
    {
        return $this->booksId;
    }

    /**
     * @param int $booksId
     */
    public function setBooksId(String $booksId):void
    {
        $this->booksId = $booksId;
    }

}