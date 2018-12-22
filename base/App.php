<?php
namespace app\base;

use app\traits\TSingleton;

class App
{
    use TSingleton;

    public $config;
    /** @var Storage */
    private $components;

    public static function call() {
        return static::getInstance();
    }

    public function run($config) {
        $this->config = $config;
        $this->components = new Storage();
        $this->runController();
    }

    private function runController() {
        $controllerName = $this->request->getControllerName() ?: $this->config['defaultController'];
        $actionName = $this->request->getActionName();

        $controllerClass = $this->getControllerClass($controllerName);
        if (class_exists($controllerClass)) {
            /** @var \app\controllers\GoodController $controller */
            $repositoryClass = $this->getRepositoryClass($controllerName);
            $controller = new $controllerClass(
                new $repositoryClass(),
                $controllerName
            );
            $controller->runAction($actionName);
        }
    }

    public function getControllerClass($controllerName) {
        return  $this->config['controllerNamespace'] . ucfirst($controllerName) . 'Controller';
    }

    public function getRepositoryClass($controllerName) {
        return  $this->config['repositoryNamespace'] . ucfirst($controllerName) . 'Repository';
    }

    public function createComponent($name) {
        if ($params = $this->config['components'][$name]) {
            $class = $params['class'];
            if (class_exists($class)) {
                unset($params['class']);
                $reflection = new \ReflectionClass($class);
                return $reflection->newInstanceArgs($params);
            }
            throw new \Exception('Component class not defined');
        }
        throw new \Exception("Configuration {$name} not found");
    }

    function __get($name) {
        return $this->components->get($name);
    }
}