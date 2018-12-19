<?php
return [
    'rootDir' => __DIR__ . '/../',
    'templatesDir' => __DIR__ . '/../views/',
    'templatesDirTwig' => __DIR__ . '/../views/twig',
    'cacheDir' => __DIR__ . '/../cache',
    'defaultController' => 'good',
    'controllerNamespace' => "app\controllers\\",
    'components' => [
        'db' => [
            'class' => \app\services\Db::class,
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'dbtest',
            'user' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'request' => [
            'class' => \app\services\Request::class
        ],
        'renderer' => [
            'class' => \app\services\renderers\TemplateRenderer::class
        ]
    ]
];