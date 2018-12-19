<?php
namespace app\services\renderers;

use app\base\App;

class TemplateRenderer implements IRenderer
{
    /**
     * @param $template
     * @param array $params
     * @return false|string
     */
    public function render($template, $params = [])
    {
        ob_start();
        extract($params);
        $templatePath = App::call()->config['templatesDir'] . $template . '.php';
        include $templatePath;
        return ob_get_clean();
    }
}