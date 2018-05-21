<?php
use \yii\web\Request;
$baseUrl = str_replace('/web', '', (new Request)->getBaseUrl());
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'language'=>'th_TH',
    'timeZone' => 'Asia/Bangkok',
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'qgRnhgDZkSyVHQvpUv0MOXM9oVUruF0l',
            'baseUrl' => $baseUrl,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mail',
            'useFileTransport' => false,
            'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    'host' => 'mail.codehansa.com',
                    'username' => "support@codehansa.com",
                    'password' => "sup@pass",
                    'port' => '587',
                    'encryption' => 'tls',
                    'streamOptions'=>[
                        'ssl'=>[
                             'verify_peer'=>false,
                             'verify_peer_name'=>false,
                             'allow_self_signed'=>true
                       ]
                     ]
                ]        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'utilityComponent' => [
          'class' => 'app\components\UtilityComponent'
        ],
        'thaiFormatter'=>[
            'class'=>'dixonsatit\thaiYearFormatter\ThaiYearFormatter',
        ],
        'db' => $db,
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
