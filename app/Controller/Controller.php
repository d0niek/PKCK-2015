<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/8/16
 * Time: 3:51 PM
 */

namespace Controller;

use Entity\Collection;

abstract class Controller
{
    /** @var \Entity\Collection $collection */
    private $collection;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    #region Getters

    /**
     * @return \Entity\Collection
     */
    public function getCollection()
    {
        return $this->collection;
    }

    #endregion
}
