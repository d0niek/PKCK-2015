<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/6/16
 * Time: 3:32 PM
 */

namespace Entity\Header;

use DateTime;
use SimpleXMLElement;
use UtilInterface\XmlEntity;

class Header implements XmlEntity
{
    const ATTRIBUTES = [
        'day' => 'dzień',
        'month' => 'miesiąc',
    ];
    const FIELDS = [
        'description' => 'opis',
        'date' => 'data',
        'authors' => 'autorzy',
        'author' => 'autor',
    ];

    /** @var string $description */
    private $description;

    /** @var \DateTime $date */
    private $date;

    /** @var \Entity\Header\Author[] $authors */
    private $authors = [];

    /**
     * Add new author
     *
     * @param \Entity\Header\Author $author
     */
    public function addAuthor(Author $author)
    {
        $this->authors[] = $author;
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
        $header = new Header();
        $header->setDescription((string) $data->{self::FIELDS['description']});

        $date = [
            (string) $data->{self::FIELDS['date']}->attributes()->{self::ATTRIBUTES['day']},
            (string) $data->{self::FIELDS['date']}->attributes()->{self::ATTRIBUTES['month']},
            '2015'
        ];
        $header->setDate(new \DateTime(implode('.', $date)));

        foreach ($data->{self::FIELDS['authors']}->children() as $authorXml) {
            $header->addAuthor(Author::loadFromXml($authorXml));
        }

        return $header;
    }

    /**
     * Save entity object to xml
     *
     * @param \SimpleXMLElement $data
     */
    public function saveToXml(SimpleXMLElement $data)
    {
        $data->addChild(self::FIELDS['description'], $this->getDescription());

        $date = $data->addChild(self::FIELDS['date']);
        $date->addAttribute(self::ATTRIBUTES['day'], $this->getDate()->format('d'));
        $date->addAttribute(self::ATTRIBUTES['month'], $this->getDate()->format('m'));

        $authors = $data->addChild(self::FIELDS['authors']);

        foreach ($this->getAuthors() as $author) {
            $authorXml = $authors->addChild(self::FIELDS['author']);

            $author->saveToXml($authorXml);
        }
    }

    #region Getters & Setters

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     *
     * @return $this
     */
    public function setDate(DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Author[]
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    #endregion
}
