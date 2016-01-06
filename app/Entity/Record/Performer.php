<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/6/16
 * Time: 4:29 PM
 */

namespace Entity\Record;

class Performer
{
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

    public function addRecord(Record $record)
    {
        $this->records[] = $record;
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
