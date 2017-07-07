<?php

namespace CodeEduBook\Events;


use CodeEduBook\Models\Book;

class BookPreIndexEvent
{
    /**
     * @var Book
     */
    private $book;
    private $ranking = 0;



    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * @return Book
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * @return int
     */
    public function getRanking()
    {
        return $this->ranking;
    }

    /**
     * @param int $ranking
     * @return BookPreIndexEvent
     */
    public function setRanking($ranking)
    {
        $this->ranking = $ranking;
        return $this;
    }




}
