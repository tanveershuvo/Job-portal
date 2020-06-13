<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
     */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],
    'github' =>
    [
        'client_id' => '41cba4f6181e33d8f00b', //Facebook API
        'client_secret' => '51cca03c2c0a0ea0c24bfa3cec7bf6d4962c0e2f', //Facebook Secret
        'redirect' => 'http://jobportal.test/job-seeker-register/github/callback',
    ],
    'facebook' =>
    [
        'client_id' => '691549344753724', //Facebook API
        'client_secret' => '73af4de3753b43301337036f2b43b775', //Facebook Secret
        'redirect' => 'http://jobportal.test/job-seeker-register/facebook/callback',
    ],
    'linkedin' =>
    [
        'client_id' => '86kh8ssmrldjvt', //Facebook API
        'client_secret' => '5S4jiOjPwSHezlwV', //Facebook Secret
        'redirect' => 'http://jobportal.test/job-seeker-register/linkedin/callback',
    ],

];
