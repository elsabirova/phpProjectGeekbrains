<?php
namespace app\services\renderers;

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
        $templatePath = TEMPLATES_DIR . $template . '.php';
        include $templatePath;
        return ob_get_clean();
    }
}