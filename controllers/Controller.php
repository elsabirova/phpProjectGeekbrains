<?php
namespace app\controllers;

use app\base\App;
use app\interfaces\IRepository;
use app\services\renderers\IRenderer;

/**
 * Class Controller управляет запросами пользователя (получаемые в виде запросов HTTP GET или POST).
 * Его основная функция — вызывать и координировать действие необходимых ресурсов и объектов, нужных для выполнения действий,
 * задаваемых пользователем. Контроллер вызывает соответствующую модель для задачи и выбирает подходящий вид.
 * @package app\controllers
 */
abstract class Controller
{
    protected $repository;

    protected $controllerName;
    protected $action;
    protected $defaultAction = "index";
    protected $useLayout;
    protected $layout = 'main';

    public function __construct(IRepository $repository, $controllerName, bool $useLayout = true) {
        $this->repository = $repository;
        $this->controllerName = $controllerName;
        $this->useLayout = $useLayout;
    }

    /**
     * @param $action
     */
    public function runAction( $action = null)
    {
        $this->action = $action?: $this->defaultAction;
        $method = "action" . ucfirst($this->action);

        if(method_exists($this, $method)){
            $this->$method();
        } else {
            echo "404";
        }
    }

    /**
     * @param $template
     * @param $params
     * @return false|string
     */
    protected function render($template, $params)
    {
        $template = $this->controllerName . '/' . $template;
        if($this->useLayout) {
            $content = $this->renderTemplate($template, $params);
            return $this->renderTemplate("layouts/{$this->layout}", ['content' => $content]);
        }

        return $this->renderTemplate($template, $params);
    }

    /**
     * @param $template
     * @param $params
     * @return false|string
     */
    protected function renderTemplate($template, $params)
    {
        return App::call()->renderer->render($template, $params);
    }
}