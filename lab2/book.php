<?php

// Task 2: Book Class Definition
class Book
{
    private $title;
    private $author;
    private $year;

    public function __construct($title, $author, $year)
    {
        $this->setTitle($title);
        $this->setAuthor($author);
        $this->setYear($year);
    }

    public function setTitle($title)
    {
        if (empty($title)) {
            throw new Exception("Title cannot be empty.");
        }
        $this->title = $title;
    }

    public function setAuthor($author)
    {
        if (empty($author)) {
            throw new Exception("Author cannot be empty.");
        }
        $this->author = $author;
    }

    public function setYear($year)
    {
        if (!is_numeric($year) || $year < 0) {
            throw new Exception("Invalid year.");
        }
        $this->year = $year;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function displayBook()
    {
        return "<tr>
        <td class='border px-4 py-2 text-center'>{$this->getTitle()}</td>
        <td class='border px-4 py-2 text-center'>{$this->getAuthor()}</td>
        <td class='border px-4 py-2 text-center'>{$this->getYear()}</td>
    </tr>";
    }
}

?>