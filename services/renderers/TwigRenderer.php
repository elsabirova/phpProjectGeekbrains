<?php
namespace app\services\renderers;

class TwigRenderer implements IRenderer
{
    protected $twig;

    /**
     * TwigRenderer constructor.
     */
    public function __construct() {
        $loader = new \Twig_Loader_Filesystem(TWIG_TEMPLATES_DIR);
        $this->twig = new \Twig_Environment($loader, array(
            'cache' => CACHE_DIR,
        ));
    }

    public function render($template, $params = [])
    {
        return $this->twig->render($template . '.html', $params);
    }
}