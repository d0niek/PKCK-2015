<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/8/16
 * Time: 4:06 PM
 */

use Entity\Collection;

class Kernel
{
    /** @var \Entity\Collection $collection */
    private $collection;

    /** @var array $routes */
    private $routes;

    /** @var string $xmlFile */
    private $xmlFile;

    public function __construct($xmlFile)
    {
        $collectionXml = new SimpleXMLElement(file_get_contents($xmlFile));

        $this->collection = Collection::loadFromXml($collectionXml);

        $this->routes = require_once(dirname(__FILE__) . '/routes.php');

        $this->xmlFile = $xmlFile;
    }

    /**
     * Reads url parameters and runs controller
     *
     * @throws \Exception
     */
    public function start()
    {
        session_start();

        $requestUri = isset($_SERVER['REQUEST_URI']) ? substr($_SERVER['REQUEST_URI'], 1) : '';

        $routeArray = $this->findRoute(explode('/', $requestUri));

        $controllerClass = 'Controller\\' . $routeArray['controller'] . 'Controller';
        $actionMethod = $routeArray['action'] . 'Action';

        $controller = new $controllerClass($this);

        call_user_func_array([$controller, $actionMethod], $routeArray['params']);
    }

    /**
     * Save collection back to xml file
     */
    public function saveCollection()
    {
        $root = file_get_contents(dirname(__FILE__) . '/Templates/collectionRoot.xml');

        $collectionXml = new SimpleXMLElement($root);

        $this->collection->saveToXml($collectionXml);

        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($collectionXml->asXML());

        $dom->save($this->xmlFile);
    }

    /**
     * Find route to requested url
     *
     * @param array $requestArray
     *
     * @return array
     * @throws \Exception
     */
    private function findRoute(array $requestArray)
    {
        foreach ($this->routes as $r) {
            $route = $this->comparePath($requestArray, $r);

            if ($route !== false) {
                return $route;
            }
        }

        throw new Exception('Route not found', 404);
    }

    /**
     * Compare requested url with route and return it
     *
     * @param array $requestArray
     * @param array $route
     *
     * @return array|bool
     */
    private function comparePath(array $requestArray, array $route)
    {
        $routeArray = explode('/', $route['route']);

        if (count($requestArray) !== count($routeArray)) {
            return false;
        }

        $pathParams = [
            'controller' => $route['controller'],
            'action' => $route['action'],
            'params' => [],
        ];

        for ($i = 0; $i < count($requestArray); $i++) {
            // Gets param from url
            if (preg_match("/{[a-zA-Z0-9\-\\_\\.]+}/", $routeArray[$i])) {
                $pathParam = substr($routeArray[$i], 1, strlen($routeArray[$i]) - 1);

                $pathParams['params'][$pathParam] = $requestArray[$i];
            } else if ($requestArray[$i] !== $routeArray[$i]) {
                return false;
            }
        }

        return $pathParams;
    }

    #region Getters

    /**
     * @return Collection
     */
    public function getCollection()
    {
        return $this->collection;
    }

    #endregion
}
