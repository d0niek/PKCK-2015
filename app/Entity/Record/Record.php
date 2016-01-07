<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/6/16
 * Time: 4:27 PM
 */

namespace Entity\Record;

use DateTime;
use SimpleXMLElement;
use UtilInterface\XmlEntity;

class Record implements XmlEntity
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

    /**
     * Read xml tags and return entity object
     *
     * @param \SimpleXMLElement $data
     *
     * @return mixed
     */
    public static function loadFromXml(SimpleXMLElement $data)
    {
        $record = new Record();
        $record->setId((string) $data->attributes()->id);

        // After load whole xml, set relationships to Performer object
        $record->performer = (string) $data->attributes()->wykonawca;

        $record->setRelease(new \DateTime((string) $data->attributes()->data_wydania));
        $record->setTitle((string) $data->{'tytuł_płyty'});
        $record->setRanking((string) $data->ranking);
        $record->setTime(new \DateTime((string) $data->czas_trwania));
        $record->setPrice((string) $data->cena);

        foreach ($data->{'lista_utworów'}->children() as $trackXml) {
            $record->addTrack(Track::loadFromXml($trackXml));
        }

        return $record;
    }

    /**
     * Save entity object to xml
     *
     * @param \SimpleXMLElement $data
     */
    public function saveToXml(SimpleXMLElement $data)
    {
        $data->addAttribute('id', $this->getId());
        $data->addAttribute('wykonawca', $this->getPerformer()->getId());
        $data->addAttribute('data_wydania', $this->getRelease()->format('Y-m-d'));
        $data->addChild('tytuł_płyty', $this->getTitle());
        $data->addChild('wykonawca_płyty', $this->getPerformer()->getName());
        $data->addChild('ranking', $this->getRanking());
        $data->addChild('czas_trwania', $this->getTime()->format('H:i:s'));
        $data->addChild('cena', $this->getPrice());

        $tracksXml = $data->addChild('lista_utworów');

        foreach ($this->getTracks() as $track) {
            $trackXml = $tracksXml->addChild('utwór');

            $track->saveToXml($trackXml);
        }
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
     * @return \Entity\Record\Performer
     */
    public function getPerformer()
    {
        return $this->performer;
    }

    /**
     * @param \Entity\Record\Performer $performer
     *
     * @return $this
     */
    public function setPerformer(Performer $performer)
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
        return $this->price;
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
     * @return \Entity\Record\Track[]
     */
    public function getTracks()
    {
        return $this->tracks;
    }

    #endregion
}
