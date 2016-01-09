<?php
/**
 * Created by PhpStorm.
 * User: d0niek
 * Date: 1/8/16
 * Time: 3:51 PM
 */

namespace Controller;

use Exception;
use Kernel;

abstract class Controller
{
    /** @var Kernel $kernel */
    private $kernel;

    /** @var string $baseUrl */
    private $baseUrl;

    public function __construct(Kernel $kernel)
    {
        $this->kernel = $kernel;
        $this->baseUrl = $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["HTTP_HOST"];
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
            $params['baseUrl'] = $this->getBaseUrl();

            extract($params);

            require_once($templateFile);
        } else {
            throw new Exception("Could not find template $templateFile");
        }
    }

    /**
     * Redirect to specific url
     *
     * @param string $url
     */
    public function redirect($url)
    {
        header("Location:$url");

        exit();
    }

    /**
     * Validate form
     *
     * @param array $post
     *
     * @return bool
     */
    protected function validForm(array $post)
    {
        $class = str_replace('Controller', '', get_class($this));
        $formClass = 'Form\\' . substr($class, 1) . 'Form';

        /** @var \Form\Form $form */
        $form = new $formClass();

        try {
            return $form->validForm($post);
        } catch (Exception $e) {
            $_SESSION['validMessage'] = $e->getMessage();

            return false;
        }
    }

    #region Getters

    /**
     * @return \Kernel
     */
    public function getKernel()
    {
        return $this->kernel;
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @return \Entity\Collection
     */
    public function getCollection()
    {
        return $this->getKernel()->getCollection();
    }

    #endregion
}
