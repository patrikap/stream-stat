<?php
return [
    'providers' => [
        'twitch' => [
            'clientId' => env('TWITCH_CLIENT_ID', null),
            'secret'   => env('TWITCH_CLIENT_SECRET', null),
        ],
    ],
];
