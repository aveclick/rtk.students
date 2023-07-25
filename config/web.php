<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
  'id' => 'basic',
  'basePath' => dirname(__DIR__),
  'defaultRoute' => '/site/about',
  'language' => 'ru-RU',
  'bootstrap' => ['log'],
  'aliases' => [
    '@bower' => '@vendor/bower-asset',
    '@npm'   => '@vendor/npm-asset',
  ],
  'components' => [
    'request' => [
      // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
      'cookieValidationKey' => 'sfsf',
      'baseUrl' => '',
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
    'mailer' =>
    [
      'class' => yii\swiftmailer\Mailer::class,
      'useFileTransport'=>false,
      'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'smtp.yandex.ru',
        'username' => 'ann.evl@yandex.ru',
        'password' => 'xsykdzrfozkxvxuu',
        'port' => '465',
        'encryption' => 'ssl',
      ],
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
    'formatter' => [
      'nullDisplay' => '&nbsp;',
    ],
    'db' => $db,

    'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'rules' => [

      ],
    ],

  ],
  'modules' => [
    'admin' => [
      'class' => 'app\modules\admin\Module',
      'defaultRoute' => 'admin',
    ],
    'manager' => [
      'class' => 'app\modules\manager\Module',
      'defaultRoute' => 'manager',
    ],
    'account' => [
      'class' => 'app\modules\account\Module',
      'defaultRoute' => 'account',
    ],
    'yii2images' => [
    'class' => 'rico\yii2images\Module',
    //be sure, that permissions ok
    //if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
    'imagesStorePath' => 'upload/store', //path to origin images
    'imagesCachePath' => 'upload/cache', //path to resized copies
    'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
    'placeHolderPath' => '@webroot/upload/store/no-image.png', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
    'imageCompressionQuality' => 100, // Optional. Default value is 85.
    ],
  ],
  'params' => $params,
];

if (YII_ENV_DEV) {
  // configuration adjustments for 'dev' environment
  $config['bootstrap'][] = 'debug';
  $config['modules']['debug'] = [
    'class' => 'yii\debug\Module',
    // uncomment the following to add your IP if you are not connecting from localhost.
    'allowedIPs' => ['*'],
  ];

  $config['bootstrap'][] = 'gii';
  $config['modules']['gii'] = [
    'class' => 'yii\gii\Module',
    // uncomment the following to add your IP if you are not connecting from localhost.
    'allowedIPs' => ['*'],
  ];
}

return $config;
