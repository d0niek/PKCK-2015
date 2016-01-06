<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/6/16
 * Time: 4:56 PM
 */

namespace Entity;

use Entity\Header\Author;
use Entity\Header\Header;
use Entity\Record\Performer;
use Entity\Record\Record;
use Entity\Record\Track;
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

        $this->loadHeader($collectionXml->{'nagłówek'});
        $this->loadRecords($collectionXml->{'płyty'});
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

    /**
     * Load header tag from xml
     *
     * @param \SimpleXMLElement $headerXml
     */
    private function loadHeader(SimpleXMLElement $headerXml)
    {
        $header = new Header();

        $header->setDescription($headerXml->opis->__toString());

        $date = $headerXml->data->attributes()->{'dzień'}->__toString() . '.';
        $date .= $headerXml->data->attributes()->{'miesiąc'}->__toString() . '.';
        $date .= '2015';
        $header->setDate(new \DateTime($date));

        foreach ($headerXml->autorzy->children() as $authorXml) {
            $author = new Author();
            $author->setName($authorXml->{'imię'}->__toString());
            $author->setSurname($authorXml->nazwisko->__toString());
            $author->setIndex($authorXml->numer_indeksu->__toString());
            $author->setCourse($authorXml->kierunek->__toString());

            $header->addAuthor($author);
        }

        $this->header = $header;
    }

    /**
     * Load records tags from xml
     *
     * @param \SimpleXMLElement $recordsXml
     */
    private function loadRecords(SimpleXMLElement $recordsXml)
    {
        foreach ($recordsXml->children() as $recordXml) {
            $record = new Record();
            $record->setId($recordXml->attributes()->id->__toString());
//            $record->setPerformer(new Performer());
            $record->setRelease(new \DateTime($recordXml->attributes()->data_wydania->__toString()));
            $record->setTitle($recordXml->{'tytuł_płyty'}->__toString());
            $record->setRanking($recordXml->ranking->__toString());
            $record->setTime(new \DateTime($recordXml->czas_trwania->__toString()));
            $record->setPrice($recordXml->cena->__toString());

            foreach ($recordXml->{'lista_utworów'}->children() as $trackXml) {
                $track = new Track();
                $track->setNumber($trackXml->attributes()->nr->__toString());
                $track->setTitle($trackXml->{'tytuł'}->__toString());
                $track->setLength(new \DateTime($trackXml->{'długość'}->__toString()));

                $record->addTrack($track);
            }

            $this->addRecord($record);
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
    public function getPerformer()
    {
        return $this->performer;
    }

    #endregion
}