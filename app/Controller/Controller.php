<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/8/16
 * Time: 3:51 PM
 */

namespace Controller;

use Entity\Collection;
use Exception;

abstract class Controller
{
    /** @var \Entity\Collection $collection */
    private $collection;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * Renders template
     *
     * @param string $template
     * @param array $params
     *
     * @throws \Exception
     */
    public function render($template, array $params = [])
    {
        $basePath = dirname(__DIR__) . '/Templates';
        $templateFile = "$basePath/$template";

        if (file_exists($templateFile)) {
            $params['header'] = $this->getCollection()->getHeader();
            $params['baseUrl'] = $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["HTTP_HOST"];

            extract($params);

            require_once($templateFile);
        } else {
            throw new Exception("Could not find template $templateFile");
        }
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
