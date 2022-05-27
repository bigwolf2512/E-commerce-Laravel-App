<?php
return [
    'client_id' => env('PAYPAL_CLIENTID', ''),
    'secret' => env('PAYPAL_SECRET', ''),
    'setting' => array(
        'mode' => env('PAYPAL_MODE', 'sandbox'),
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/log/paypal.log',
        'log.LogLevel' => 'ERROR'
    ),
];
