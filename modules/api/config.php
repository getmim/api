<?php

return [
    '__name' => 'api',
    '__version' => '0.0.1',
    '__git' => 'git@github.com:getmim/api.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'http://iqbalfn.com/'
    ],
    '__files' => [
        'modules/api' => ['install','update','remove']
    ],
    '__dependencies' => [
        'required' => [],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'Api\\Controller' => [
                'type' => 'file',
                'base' => 'modules/api/system/Controller.php',
                'children' => 'modules/api/controller'
            ]
        ],
        'files' => []
    ],
    'gates' => [
        'api' => [
            'priority' => 10000,
            'host' => [
                'value' => 'HOST'
            ],
            'path' => [
                'value' => '/api'
            ]
        ]
    ],
    'routes' => [
        'api' => [
            '404' => [
                'handler' => 'Api\\Controller::show404'
            ],
            '500' => [
                'handler' => 'Api\\Controller::show500'
            ]
        ]
    ]
];