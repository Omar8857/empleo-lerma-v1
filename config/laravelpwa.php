<?php

return [
    'name' => 'LaravelPWA',
    'manifest' => [
        'name' => env('APP_NAME', 'My PWA App'),
        'short_name' => 'Empleo Lerma',
        'start_url' => '/',
        'background_color' => '#921769',
        'theme_color' => '#8c348b',
        'display' => 'standalone',
        'orientation'=> 'any',
        'status_bar'=> 'black',
        'icons' => [
            '72x72' => [
                'path' => '/empleo-lerma/public/images/icons/icon-72x72.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => '/empleo-lerma/public/images/icons/icon-96x96.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => '/empleo-lerma/public/images/icons/icon-128x128.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => '/empleo-lerma/public/images/icons/icon-144x144.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => '/empleo-lerma/public/images/icons/icon-152x152.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => '/empleo-lerma/public/images/icons/icon-192x192.png',
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => '/empleo-lerma/public/images/icons/icon-384x384.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => '/empleo-lerma/public/images/icons/icon-512x512.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => '/empleo-lerma/public/images/icons/splash-640x1136.jpg',
            '750x1334' => '/empleo-lerma/public/images/icons/splash-750x1334.jpg',
            '828x1792' => '/empleo-lerma/public/images/icons/splash-828x1792.jpg',
            '1125x2436' => '/empleo-lerma/public/images/icons/splash-1125x2436.jpg',
            '1242x2208' => '/empleo-lerma/public/images/icons/splash-1242x2208.jpg',
            '1242x2688' => '/empleo-lerma/public/images/icons/splash-1242x2688.jpg',
            '1536x2048' => '/empleo-lerma/public/images/icons/splash-1536x2048.jpg',
            '1668x2224' => '/empleo-lerma/public/images/icons/splash-1668x2224.jpg',
            '1668x2388' => '/empleo-lerma/public/images/icons/splash-1668x2388.jpg',
            '2048x2732' => '/empleo-lerma/public/images/icons/splash-2048x2732.jpg',
        ],
        'shortcuts' => [
            [
                'name' => 'Shortcut Link 1',
                'description' => 'Shortcut Link 1 Description',
                'url' => '/shortcutlink1',
                'icons' => [
                    "src" => "/empleo-lerma/public/images/icons/icon-72x72.png",
                    "purpose" => "any"
                ]
            ],
            [
                'name' => 'Shortcut Link 2',
                'description' => 'Shortcut Link 2 Description',
                'url' => '/shortcutlink2'
            ]
        ],
        'custom' => []
    ]
];
