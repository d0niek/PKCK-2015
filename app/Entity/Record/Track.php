<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/6/16
 * Time: 4:22 PM
 */

namespace Entity\Record;

use DateTime;
use SimpleXMLElement;
use UtilInterface\XmlEntity;

class Track implements XmlEntity
{
    /** @var int $number */
    private $number;

    /** @var string $title */
    private $title;

    /** @var \DateTime $length */
    private $length;

    /**
     * Read xml tags and return entity object
     *
     * @param \SimpleXMLElement $data
     *
     * @return mixed
     */
    public static function loadFromXml(SimpleXMLElement $data)
    {
        $track = new Track();
        $track->setNumber((string) $data->attributes()->nr);
        $track->setTitle((string) $data->{'tytuł'});
        $track->setLength(new \DateTime((string) $data->{'długość'}));

        return $track;
    }

    /**
     * Save entity object to xml
     *
     * @param \SimpleXMLElement $data
     */
    public function saveToXml(SimpleXMLElement $data)
    {
        $data->addAttribute('nr', $this->getNumber());
        $data->addChild('tytuł', htmlspecialchars($this->getTitle()));
        $data->addChild('długość', $this->getLength()->format('H:i:s'));
    }

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
        return $this->length;
    }

    /**
     * @param \DateTime $length
     *
     * @return $this
     */
    public function setLength(DateTime $length)
    {
        $this->length = $length;

        return $this;
    }

    #endregion
}
