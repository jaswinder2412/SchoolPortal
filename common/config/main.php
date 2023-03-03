<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
		'reCaptcha' => [
        'name' => 'reCaptcha',
        'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
        'siteKey' => '6LfawEAUAAAAADZG3JCczN2IU5Z2M54vx9DxmWon',
        'secret' => '6LfawEAUAAAAAPFZCI82rtLXhj9VvM1fBlD_yT7u',
    ],
    ],
];
