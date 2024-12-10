<?php

return [
    'mode'    => env('PAYPAL_MODE', 'sandbox'),
    'sandbox' => [
        'client_id'         => env('PAYPAL_SANDBOX_CLIENT_ID', ''),
        'client_secret'     => env('PAYPAL_SANDBOX_CLIENT_SECRET', ''),
        'app_id'            => 'APP-80W284485P519543T',
    ],
    'live' => [
        'client_id'         => env('PAYPAL_LIVE_CLIENT_ID', ''),
        'client_secret'     => env('PAYPAL_LIVE_CLIENT_SECRET', ''),
        'app_id'            => env('PAYPAL_LIVE_APP_ID', ''),
    ],
    'settings' => [
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path('logs/paypal.log'),
        'log.LogLevel' => 'ERROR'
    ],
    'payment_action' => 'Sale',
    'currency'       => 'USD',
    'notify_url'     => '',
    'locale'         => 'en_US',
    'validate_ssl'   => true,
];