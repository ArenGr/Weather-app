<?php

return [
    'services' => [
        'openweathermap' => [
            'url' => env('OPENWEATHERMAP_URL', 'https://api.openweathermap.org/data/2.5/weather'),
            'key' => env('OPENWEATHERMAP_KEY'),
        ],
    ]
];
