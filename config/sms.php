<?php

return [

    /*
    |--------------------------------------------------------------------------
    | adaReach Business SMS API Configuration
    |--------------------------------------------------------------------------
    |
    | API Base URL : https://api.mobireach.com.bd
    | Auth         : POST /auth/tokens  (username + password → Bearer token)
    | Send SMS     : POST /sms/send     (Authorization: Bearer <token>)
    | Token TTL    : 1 hour (cached for 55 min with auto-refresh)
    |
    */

    'adarreach_username'  => env('ADARREACH_USERNAME', ''),
    'adarreach_password'  => env('ADARREACH_PASSWORD', ''),
    'adarreach_sender_id' => env('ADARREACH_SENDER_ID', ''),
    'adarreach_base_url'  => env('ADARREACH_BASE_URL', 'https://api.mobireach.com.bd'),

];
