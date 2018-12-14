<?php
namespace app\services\renderers;

class TwigRenderer implements IRenderer
{
    public function render($templateName, $params = [])
    {
        $loader = new \Twig_Loader_Filesystem(TWIG_TEMPLATES_DIR);
        $twig = new \Twig_Environment($loader, array(
            'cache' => TWIG_CACHE_DIR,
        ));

        $template = $twig->load($templateName . '.html');
        return $template->render($params);
    }
}