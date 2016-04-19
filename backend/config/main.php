<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log', 'app\components\PostPublisher'],
    'modules' => [
        'posts' => [
            'class' => 'app\modules\posts\Module',
        ],
        'users' => [
            'class' => 'app\modules\users\Module',
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'elephantio' => [
            'class' => 'sammaye\elephantio\ElephantIo',
            'host' => 'http://localhost:3000'
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                /* posts */
                '<_m:(posts)>' => '<_m>/posts/index',
                '<_m:(posts)>/<_a:(index|create)>' => '<_m>/posts/<_a>',
                '<_m:(posts)>/<_a:(update|view|delete|restore)>/<id:\d+>' => '<_m>/posts/<_a>',
                /* users */
                '<_m:(users)>' => '<_m>/users/index',
                '<_m:(users)>/<_a:(index|create)>' => '<_m>/users/<_a>',
                '<_m:(users)>/<_a:(update|view|delete|restore)>/<id:\d+>' => '<_m>/users/<_a>',
                /* --- */
                '<_c:\w+>' => '<_c>/index',
                '<_c:\w+>/<_a:\w+>' => '<_c>/<_a>',
                '<_c:\w+>/<_a:\w+>/<id:\d+>' => '<_c>/<_a>',
            ],
        ],
    ],
    'params' => $params,
];
