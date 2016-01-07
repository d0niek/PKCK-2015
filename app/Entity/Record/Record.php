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
    const ATTRIBUTES = [
        'id' => 'id',
        'performer' => 'wykonawca',
        'release' => 'data_wydania',
    ];
    const FIELDS = [
        'title' => 'tytuł_płyty',
        'performer' => 'wykonawca_płyty',
        'ranking' => 'ranking',
        'time' => 'czas_trwania',
        'price' => 'cena',
        'tracks' => 'lista_utworów',
        'track' => 'utwór',
    ];

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
        $record->setId((string) $data->attributes()->{self::ATTRIBUTES['id']});

        // After load whole xml, set relationships to Performer object
        $record->performer = (string) $data->attributes()->{self::ATTRIBUTES['performer']};

        $record->setRelease(new \DateTime((string) $data->attributes()->{self::ATTRIBUTES['release']}));
        $record->setTitle((string) $data->{self::FIELDS['title']});
        $record->setRanking((string) $data->{self::FIELDS['ranking']});
        $record->setTime(new \DateTime((string) $data->{self::FIELDS['time']}));
        $record->setPrice((string) $data->{self::FIELDS['price']});

        foreach ($data->{self::FIELDS['tracks']}->children() as $trackXml) {
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
        $data->addAttribute(self::ATTRIBUTES['id'], $this->getId());
        $data->addAttribute(self::ATTRIBUTES['performer'], $this->getPerformer()->getId());
        $data->addAttribute(self::ATTRIBUTES['release'], $this->getRelease()->format('Y-m-d'));
        $data->addChild(self::FIELDS['title'], $this->getTitle());
        $data->addChild(self::FIELDS['performer'], $this->getPerformer()->getName());
        $data->addChild(self::FIELDS['ranking'], $this->getRanking());
        $data->addChild(self::FIELDS['time'], $this->getTime()->format('H:i:s'));
        $data->addChild(self::FIELDS['price'], $this->getPrice());

        $tracksXml = $data->addChild(self::FIELDS['tracks']);

        foreach ($this->getTracks() as $track) {
            $trackXml = $tracksXml->addChild(self::FIELDS['track']);

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
