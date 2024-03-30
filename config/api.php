<?php

return [
    'services' => [
        'openweathermap' => [
            'key' => env('OPENWEATHERMAP_KEY'),
            'url' => env('OPENWEATHERMAP_URL', 'https://api.openweathermap.org/data/2.5/weather'),
            'reverse_url' => env('OPENWEATHERMAP_URL_REVERSE', 'http://api.openweathermap.org/geo/1.0/reverse')
        ],
    ]
];
