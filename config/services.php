<?php

return [
    'dummyjson' => [
        'url' => env('DUMMYJSON_API_URL', 'https://dummyjson.com'),
        'timeout' => env('DUMMYJSON_TIMEOUT', 30),
    ],

    'cache' => [
        'ttl' => env('CACHE_TTL', 3600),
    ],

    'pagination' => [
        'per_page' => env('PAGINATION_PER_PAGE', 15),
    ],
];
