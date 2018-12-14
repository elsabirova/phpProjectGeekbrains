<?php
namespace app\controllers;

use app\services\renderers\IRenderer;

/**
 * Class Controller управляет запросами пользователя (получаемые в виде запросов HTTP GET или POST).
 * Его основная функция — вызывать и координировать действие необходимых ресурсов и объектов, нужных для выполнения действий,
 * задаваемых пользователем. Контроллер вызывает соответствующую модель для задачи и выбирает подходящий вид.
 * @package app\controllers
 */
abstract class Controller
{
    protected $renderer;

    protected $action;
    protected $defaultAction = "index";
    protected $useLayout;
    protected $layout = 'main';

    /**
     * Controller constructor.
     * @param bool $useLayout
     * @param $renderer
     */
    public function __construct(IRenderer $renderer, bool $useLayout = true) {
        $this->useLayout = $useLayout;
        $this->renderer = $renderer;
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
        return $this->renderer->render($template, $params);
    }
}