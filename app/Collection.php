<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/6/16
 * Time: 4:56 PM
 */

use Entity\Header\Header;
use Entity\Record\Performer;
use Entity\Record\Record;

class Collection
{
    /** @var \Entity\Header\Header $header */
    private $header;

    /** @var \Entity\Record\Record[] $records */
    private $records = [];

    /** @var \Entity\Record\Performer[] $performers */
    private $performers = [];

    /**
     * Load data from xml file
     *
     * @param string $xmlFile
     */
    public function loadFromXml($xmlFile)
    {
        $collectionXml = new SimpleXMLElement(file_get_contents($xmlFile));

        $this->header = Header::loadFromXml($collectionXml->{'nagłówek'});

        foreach ($collectionXml->{'płyty'}->children() as $recordXml) {
            $this->addRecord(Record::loadFromXml($recordXml));
        }

        foreach ($collectionXml->wykonawcy->children() as $performerXml) {
            $this->addPerformer(Performer::loadFromXml($performerXml));
        }

        $this->setRelationships();
    }

    /**
     * Save collection as xml file
     */
    public function saveAsXml()
    {
    }

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
     * Add new performer
     *
     * @param \Entity\Record\Performer $performer
     */
    public function addPerformer(Performer $performer)
    {
        $this->performers[] = $performer;
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

    /**
     * Find record in collection by Id
     *
     * @param string $recordId
     *
     * @return \Entity\Record\Record
     * @throws \Exception
     */
    private function findRecordById($recordId)
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
    private function findPerformerById($performerId)
    {
        foreach ($this->performers as $performer) {
            if ($performer->getId() === $performerId) {
                return $performer;
            }
        }

        throw new Exception("Not found performer with Id $performerId");
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
