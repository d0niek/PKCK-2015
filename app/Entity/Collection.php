<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/6/16
 * Time: 4:56 PM
 */

namespace Entity;

use Entity\Record\Performer;
use Entity\Record\Record;
use SimpleXMLElement;

class Collection
{
    /** @var \Entity\Header\Header $header */
    private $header;

    /** @var \Entity\Record\Record[] $records */
    private $records = [];

    /** @var \Entity\Record\Performer[] = $performer */
    private $performer = [];

    /**
     * Load data from xml file
     *
     * @param string $xmlFile
     */
    public function loadFromXml($xmlFile)
    {
        $collectionXml = new SimpleXMLElement(file_get_contents($xmlFile));
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
        $this->performer[] = $performer;
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
    public function getPerformer()
    {
        return $this->performer;
    }

    #endregion
}
