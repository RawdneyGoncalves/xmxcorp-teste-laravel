<?php

return [
    'name' => env('APP_NAME', 'Blog'),
    'env' => env('APP_ENV', 'production'),
    'debug' => (bool) env('APP_DEBUG', false),
    'url' => env('APP_URL', 'http://localhost'),
    'timezone' => 'America/Sao_Paulo',
    'locale' => 'pt_BR',
    'fallback_locale' => 'en',
    'locale_fallback' => env('LOCALE_FALLBACK', 'en'),
    'cipher' => 'AES-256-CBC',
    'key' => env('APP_KEY'),
    'prev_keys' => [
        ...explode(',', env('APP_PREVIOUS_KEYS', '')),
    ],
];
