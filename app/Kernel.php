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

    public function __construct($xmlFile)
    {
        $collectionXml = new SimpleXMLElement(file_get_contents($xmlFile));

        $this->collection = Collection::loadFromXml($collectionXml);

        $this->routes = require_once(dirname(__FILE__) . '/routes.php');
    }

    /**
     * Reads url parameters and runs controller
     *
     * @throws \Exception
     */
    public function start()
    {
        $pathInfo = isset($_SERVER['PATH_INFO']) ? substr($_SERVER['PATH_INFO'], 1) : '';

        $routeArray = $this->findRoute(explode('/', $pathInfo));

        $controllerClass = 'Controller\\' . $routeArray['controller'] . 'Controller';
        $actionMethod = $routeArray['action'] . 'Action';

        $controller = new $controllerClass($this->collection);
        $controller->$actionMethod();
    }

    /**
     * Find route to requested url
     *
     * @param array $pathArray
     *
     * @return array
     * @throws \Exception
     */
    private function findRoute(array $pathArray)
    {
        foreach ($this->routes as $r) {
            $route = $this->comparePath($pathArray, $r);

            if ($route !== false) {
                return $route;
            }
        }

        throw new Exception('Route not found', 404);
    }

    /**
     * Compare requested url with route and return it
     *
     * @param array $pathArray
     * @param array $route
     *
     * @return array|bool
     */
    private function comparePath(array $pathArray, array $route)
    {
        $routeArray = explode('/', $route['route']);

        if (count($pathArray) !== count($routeArray)) {
            return false;
        }

        $pathParams = [
            'controller' => $route['controller'],
            'action' => $route['action'],
            'params' => [],
        ];

        for ($i = 0; $i < count($pathArray); $i++) {
            // Gets param from url
            if (preg_match("/{[a-zA-Z0-9\-\\_\\.]+}/", $routeArray[$i])) {
                $pathParam = substr($routeArray[$i], 1, strlen($routeArray[$i]) - 1);

                $pathParams['params'][$pathParam] = $pathArray[$i];
            } else if ($pathArray[$i] !== $routeArray[$i]) {
                return false;
            }
        }

        return $pathParams;
    }
}
