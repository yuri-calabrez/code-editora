<?php

return [
    'email' => [
        'user_created' => [
            'subject' => config('app.name').' - Sua conta foi criada!'
        ]
    ],
    'middleware' => [
        'isVerified' => 'isVerified'
    ],
    'user_default' => [
        'name' => env('USER_NAME', 'Administrator'),
        'email' => env('USER_EMAIL', 'admin@user.com'),
        'password' => env('USER_PASSWORD', '123456')
    ],
    'acl' => [
        'role_admin' => env('ROLE_ADMIN', 'Admin'),
        'controllers_annotations' => [
            __DIR__.'/../Http/Controllers'
        ]
    ]
];
