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
use Exception;
use SimpleXMLElement;

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

        $this->loadHeader($collectionXml->{'nagłówek'});
        $this->loadRecords($collectionXml->{'płyty'});
        $this->loadPerformers($collectionXml->wykonawcy);

        foreach ($this->records as $record) {
            $performer = $this->findPerformerById($record->getPerformer());

            $record->setPerformer($performer);
        }
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
     * Load header tag from xml
     *
     * @param \SimpleXMLElement $headerXml
     */
    private function loadHeader(SimpleXMLElement $headerXml)
    {
        $header = new Header();

        $header->setDescription((string) $headerXml->opis);

        $date = (string) $headerXml->data->attributes()->{'dzień'} . '.';
        $date .= (string) $headerXml->data->attributes()->{'miesiąc'} . '.';
        $date .= '2015';
        $header->setDate(new \DateTime($date));

        foreach ($headerXml->autorzy->children() as $authorXml) {
            $author = new Author();
            $author->setName((string) $authorXml->{'imię'});
            $author->setSurname((string) $authorXml->nazwisko);
            $author->setIndex((string) $authorXml->numer_indeksu);
            $author->setCourse((string) $authorXml->kierunek);

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
            $record->setId((string) $recordXml->attributes()->id);

            // After load performers have to change Id to Performer value
            $record->setPerformer((string) $recordXml->attributes()->wykonawca);
            $record->setRelease(new \DateTime((string) $recordXml->attributes()->data_wydania));
            $record->setTitle((string) $recordXml->{'tytuł_płyty'});
            $record->setRanking((string) $recordXml->ranking);
            $record->setTime(new \DateTime((string) $recordXml->czas_trwania));
            $record->setPrice((string) $recordXml->cena);

            foreach ($recordXml->{'lista_utworów'}->children() as $trackXml) {
                $track = new Track();
                $track->setNumber((string) $trackXml->attributes()->nr);
                $track->setTitle((string) $trackXml->{'tytuł'});
                $track->setLength(new \DateTime((string) $trackXml->{'długość'}));

                $record->addTrack($track);
            }

            $this->addRecord($record);
        }
    }

    /**
     * Load performers tags from Xml
     *
     * @param \SimpleXMLElement $performersXml
     */
    private function loadPerformers(SimpleXMLElement $performersXml)
    {
        foreach ($performersXml->children() as $performerXml) {
            $performer = new Performer();
            $performer->setId((string) $performerXml->attributes()->id);
            $performer->setName((string) $performerXml->attributes()->nazwa);
            $performer->setType((string) $performerXml->attributes()->gatunek);

            $members = isset($performerXml->attributes()->{'członków'}) ?
                (string) $performerXml->attributes()->{'członków'} :
                1;
            $performer->setMembers((int) $members);

            foreach ($performerXml->{'wydał'} as $recordXml) {
                $record = $this->findRecordById((string) $recordXml->attributes()->nagranie);

                $performer->addRecord($record);
            }

            $this->addPerformer($performer);
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
