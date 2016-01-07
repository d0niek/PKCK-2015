<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/6/16
 * Time: 4:29 PM
 */

namespace Entity\Record;

use SimpleXMLElement;
use UtilInterface\XmlEntity;

class Performer implements XmlEntity
{
    const ATTRIBUTES = [
        'id' => 'id',
        'name' => 'nazwa',
        'type' => 'gatunek',
        'members' => 'członków',
        'record' => 'nagranie',
    ];
    const FIELDS = [
        'produce' => 'wydał',
    ];

    /** @var string $id */
    private $id;

    /** @var string $name */
    private $name;

    /** @var string $type */
    private $type;

    /** @var int $members */
    private $members;

    /** @var \Entity\Record\Record[] $records */
    private $records = [];

    /**
     * Add new record
     *
     * @param \Entity\Record\Record $record
     */
    public function addRecord(Record $record)
    {
        $this->records[] = $record;
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
        $performer = new Performer();
        $performer->setId((string) $data->attributes()->{self::ATTRIBUTES['id']});
        $performer->setName((string) $data->attributes()->{self::ATTRIBUTES['name']});
        $performer->setType((string) $data->attributes()->{self::ATTRIBUTES['type']});

        $members = isset($data->attributes()->{self::ATTRIBUTES['members']}) ?
            (string) $data->attributes()->{self::ATTRIBUTES['members']} :
            1;
        $performer->setMembers((int) $members);

        foreach ($data->{self::FIELDS['produce']} as $recordXml) {
            // After load whole xml, set relationships to Record object
            $performer->records[] = (string) $recordXml->attributes()->{self::ATTRIBUTES['record']};
        }

        return $performer;
    }

    /**
     * Save entity object to xml
     *
     * @param \SimpleXMLElement $data
     */
    public function saveToXml(SimpleXMLElement $data)
    {
        $data->addAttribute(self::ATTRIBUTES['id'], $this->getId());
        $data->addAttribute(self::ATTRIBUTES['name'], $this->getName());
        $data->addAttribute(self::ATTRIBUTES['type'], $this->getType());
        $data->addAttribute(self::ATTRIBUTES['members'], $this->getMembers());

        foreach ($this->getRecords() as $record) {
            $recordXml = $data->addChild(self::FIELDS['produce']);

            $recordXml->addAttribute(self::ATTRIBUTES['record'], $record->getId());
        }
    }

    #region Getters & Setter

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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * @param int $members
     *
     * @return $this
     */
    public function setMembers($members)
    {
        $this->members = $members;

        return $this;
    }

    /**
     * @return Record[]
     */
    public function getRecords()
    {
        return $this->records;
    }

    #endregion
}
