<?php
namespace app\services\renderers;

class TwigRenderer implements IRenderer
{
    protected $twig;

    /**
     * TwigRenderer constructor.
     */
    public function __construct() {
        $loader = new \Twig_Loader_Filesystem(App::call()->config['templatesDirTwig']);
        $this->twig = new \Twig_Environment($loader, array(
            'cache' => App::call()->config['cacheDir'],
        ));
    }

    public function render($template, $params = [])
    {
        return $this->twig->render($template . '.html', $params);
    }
}