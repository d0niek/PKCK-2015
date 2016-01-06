<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/6/16
 * Time: 4:22 PM
 */

namespace Entity\Record;

use DateTime;

class Track
{
    /** @var int $number */
    private $number;

    /** @var string $title */
    private $title;

    /** @var \DateTime $time */
    private $time;

    #region Getters & Setters

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param int $number
     *
     * @return $this
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLength()
    {
        return $this->time;
    }

    /**
     * @param \DateTime $time
     *
     * @return $this
     */
    public function setLength(DateTime $time)
    {
        $this->time = $time;

        return $this;
    }

    #endregion
}
