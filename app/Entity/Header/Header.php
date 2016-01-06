<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/6/16
 * Time: 3:32 PM
 */

namespace Entity\Header;

use DateTime;

class Header
{
    /** @var string $description */
    private $description;

    /** @var \DateTime $date */
    private $date;

    /** @var \Entity\Header\Author[] $authors */
    private $authors = [];

    /**
     * Add new author
     *
     * @param \Entity\Header\Author $author
     */
    public function addAuthor(Author $author)
    {
        $this->authors[] = $author;
    }

    #region Getters & Setters

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     *
     * @return $this
     */
    public function setDate(DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Author[]
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    #endregion
}
