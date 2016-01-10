<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/6/16
 * Time: 4:56 PM
 */

namespace Entity;

use Entity\Header\Header;
use Entity\Record\Performer;
use Entity\Record\Record;
use Exception;
use SimpleXMLElement;
use UtilInterface\XmlEntity;

class Collection implements XmlEntity
{
    const FIELDS = [
        'header' => 'nagłówek',
        'records' => 'płyty',
        'record' => 'płyta',
        'performers' => 'wykonawcy',
        'performer' => 'wykonawca',
    ];

    /** @var \Entity\Header\Header $header */
    private $header;

    /** @var \Entity\Record\Record[] $records */
    private $records = [];

    /** @var \Entity\Record\Performer[] $performers */
    private $performers = [];

    private function __construct()
    {
    }

    /**
     * Add new record
     *
     * @param \Entity\Record\Record $record
     */
    public function addRecord(Record $record)
    {
        if (count($this->records) > 0) {
            $recordId = 0;

            foreach ($this->records as $r) {
                $id = substr($r->getId(), 2);

                if ($id > $recordId) {
                    $recordId = $id;
                }
            }

            $recordId++;
        } else {
            $recordId = 1;
        }

        $record->setId("CD$recordId");

        $this->records[] = $record;
    }

    /**
     * Delete record from list
     *
     * @param \Entity\Record\Record $record
     */
    public function deleteRecord(Record $record)
    {
        for ($i = 0; $i < count($this->records); $i++) {
            if ($this->records[$i]->getId() === $record->getId()) {
                unset($this->records[$i]);

                break;
            }
        }
    }

    /**
     * Add new performer
     *
     * @param \Entity\Record\Performer $performer
     */
    public function addPerformer(Performer $performer)
    {
        $this->performers[] = $performer;
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
        $collection = new Collection();

        $collection->header = Header::loadFromXml($data->{self::FIELDS['header']});

        foreach ($data->{self::FIELDS['records']}->children() as $recordXml) {
            $collection->records[] = Record::loadFromXml($recordXml);
        }

        foreach ($data->{self::FIELDS['performers']}->children() as $performerXml) {
            $collection->addPerformer(Performer::loadFromXml($performerXml));
        }

        $collection->setRelationships();

        return $collection;
    }

    /**
     * Save entity object to xml
     *
     * @param \SimpleXMLElement $data
     */
    public function saveToXml(SimpleXMLElement $data)
    {
        $headerXml = $data->addChild(self::FIELDS['header']);
        $this->header->saveToXml($headerXml);

        $recordsXml = $data->addChild(self::FIELDS['records']);
        foreach ($this->getRecords() as $record) {
            $recordXml = $recordsXml->addChild(self::FIELDS['record']);

            $record->saveToXml($recordXml);
        }

        $performersXml = $data->addChild(self::FIELDS['performers']);
        foreach ($this->getPerformers() as $performer) {
            $performerXml = $performersXml->addChild(self::FIELDS['performer']);

            $performer->saveToXml($performerXml);
        }
    }

    /**
     * Find record in collection by Id
     *
     * @param string $recordId
     *
     * @return \Entity\Record\Record
     * @throws \Exception
     */
    public function findRecordById($recordId)
    {
        foreach ($this->records as $record) {
            if ($record->getId() === $recordId) {
                return $record;
            }
        }

        throw new Exception("Not found record with Id $recordId");
    }

    /**
     * Find performer in collection by Id
     *
     * @param string $performerId
     *
     * @return \Entity\Record\Performer
     * @throws \Exception
     */
    public function findPerformerById($performerId)
    {
        foreach ($this->performers as $performer) {
            if ($performer->getId() === $performerId) {
                return $performer;
            }
        }

        throw new Exception("Not found performer with Id $performerId");
    }

    /**
     * Set relationships between objects
     *
     * @throws \Exception
     */
    private function setRelationships()
    {
        // Set relationships for records
        foreach ($this->records as $record) {
            $performer = $this->findPerformerById($record->getPerformer());

            $record->setPerformer($performer);
        }

        // Set relationships fot performers
        foreach ($this->performers as $performer) {
            foreach ($performer->getRecords() as &$record) {
                $record = $this->findRecordById($record);
            }
        }
    }

    #region Getters

    /**
     * @return \Entity\Header\Header
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @return \Entity\Record\Record[]
     */
    public function getRecords()
    {
        return $this->records;
    }

    /**
     * @return \Entity\Record\Performer[]
     */
    public function getPerformers()
    {
        return $this->performers;
    }

    #endregion
}
