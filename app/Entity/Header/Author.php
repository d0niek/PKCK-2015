<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/6/16
 * Time: 4:12 PM
 */

namespace Entity\Header;

use SimpleXMLElement;
use UtilInterface\XmlEntity;

class Author implements XmlEntity
{
    /** @var string $name */
    private $name;

    /** @var string $surname */
    private $surname;

    /** @var string $index */
    private $index;

    /** @var string $course */
    private $course;

    /**
     * Read xml tags and return entity object
     *
     * @param \SimpleXMLElement $data
     *
     * @return mixed
     */
    public static function loadFromXml(SimpleXMLElement $data)
    {
        $author = new Author();
        $author->setName((string) $data->{'imię'});
        $author->setSurname((string) $data->nazwisko);
        $author->setIndex((string) $data->numer_indeksu);
        $author->setCourse((string) $data->kierunek);

        return $author;
    }

    /**
     * Save entity object to xml
     *
     * @param \SimpleXMLElement $data
     */
    public function saveToXml(SimpleXMLElement $data)
    {
        $data->addChild('imię', $this->getName());
        $data->addChild('nazwisko', $this->getSurname());
        $data->addChild('numer_indeksu', $this->getIndex());
        $data->addChild('kierunek', $this->getCourse());
    }

    #region Getters & Setters

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
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     *
     * @return $this
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return string
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @param string $index
     *
     * @return $this
     */
    public function setIndex($index)
    {
        $this->index = $index;

        return $this;
    }

    /**
     * @return string
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * @param string $course
     *
     * @return $this
     */
    public function setCourse($course)
    {
        $this->course = $course;

        return $this;
    }

    #endregion
}
