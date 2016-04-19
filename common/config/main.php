<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii-app',
            'username' => 'yii-app',
            'password' => 'yii-app',
            'charset' => 'utf8',
            'tablePrefix' => 'app_',
            'enableSchemaCache' => true,
            'schemaCacheDuration' => 3600,
            'schemaCache' => 'cache',
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        'app' => 'app.php',
                    ],
                ],
            ],
        ],
        'formatter' => [
            'timeZone' => 'Asia/Novosibirsk',
            'dateFormat' => 'dd-MM-Y',
            'timeFormat' => 'H:i:s',
            'datetimeFormat' => 'dd-MM-Y H:i:s',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
