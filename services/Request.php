<?php
namespace app\services;

class Request
{
    private $requestString;
    private $controllerName;
    private $actionName;
    private $params;
    private $requestMethod;
    private $isAjax = false;
    private $isPost = false;

    /**
     * Request constructor.
     */
    public function __construct() {
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->parseRequest();
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->isAjax = true;
        }
    }

    private function parseRequest()
    {
        $pattern = '#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)?#ui';
        if(preg_match_all($pattern, $this->requestString, $matches)) {
            $this->controllerName = $matches['controller'][0];
            $this->actionName = $matches['action'][0];
            $this->params = $_REQUEST;
        }
    }

    public function getControllerName()
    {
        return $this->controllerName;
    }

    public function getActionName()
    {
        return $this->actionName;
    }

    public function getParam($key)
    {
        return $this->params[$key];
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    public function isAjax()
    {
        return $this->isAjax;
    }

    public function isPost()
    {
        return ($this->requestMethod == 'POST');
    }

}