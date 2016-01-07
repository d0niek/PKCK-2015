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
    const FIELDS = [
        'name' => 'imię',
        'surname' => 'nazwisko',
        'index' => 'numer_indeksu',
        'course' => 'kierunek',
    ];

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
        $author->setName((string) $data->{self::FIELDS['name']});
        $author->setSurname((string) $data->{self::FIELDS['surname']});
        $author->setIndex((string) $data->{self::FIELDS['index']});
        $author->setCourse((string) $data->{self::FIELDS['course']});

        return $author;
    }

    /**
     * Save entity object to xml
     *
     * @param \SimpleXMLElement $data
     */
    public function saveToXml(SimpleXMLElement $data)
    {
        $data->addChild(self::FIELDS['name'], $this->getName());
        $data->addChild(self::FIELDS['surname'], $this->getSurname());
        $data->addChild(self::FIELDS['index'], $this->getIndex());
        $data->addChild(self::FIELDS['course'], $this->getCourse());
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
