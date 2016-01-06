<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/6/16
 * Time: 4:27 PM
 */

namespace Entity\Record;

use DateTime;

class Record
{
    /** @var string $id */
    private $id;

    /** @var \Entity\Record\Performer $performer */
    private $performer;

    /** @var \DateTime $release */
    private $release;

    /** @var string $title */
    private $title;

    /** @var float $ranking */
    private $ranking;

    /** @var \DateTime $time */
    private $time;

    /** @var float $price */
    private $price;

    /** @var \Entity\Record\Track[] $tracks */
    private $tracks = [];

    /**
     * Add new track
     *
     * @param \Entity\Record\Track $track
     */
    public function addTrack(Track $track)
    {
        $this->tracks[] = $track;
    }

    #region Getters & Setters

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Performer
     */
    public function getPerformer()
    {
        return $this->performer;
    }

    /**
     * @param Performer $performer
     *
     * @return $this
     */
    public function setPerformer($performer)
    {
        $this->performer = $performer;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getRelease()
    {
        return $this->release;
    }

    /**
     * @param \DateTime $release
     *
     * @return $this
     */
    public function setRelease($release)
    {
        $this->release = $release;

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
     * @return float
     */
    public function getRanking()
    {
        return $this->ranking;
    }

    /**
     * @param float $ranking
     *
     * @return $this
     */
    public function setRanking($ranking)
    {
        $this->ranking = $ranking;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param \DateTime $time
     *
     * @return $this
     */
    public function setTime(DateTime $time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return number_format($this->price, 2, ',');
    }

    /**
     * @param float $price
     *
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Track[]
     */
    public function getTracks()
    {
        return $this->tracks;
    }

    #endregion
}
