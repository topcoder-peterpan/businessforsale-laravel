<?php

return [

    'defaults' => [
        'guard' => 'super_admin',
        'passwords' => 'users',
    ],
    'guards' => [
        'super_admin' => [
            'driver' => 'session',
            'provider' => 'super_admins',
        ],
        'customer' => [
            'driver' => 'session',
            'provider' => 'customers',
        ],
        'api' => [
            'driver' => 'token',
            'provider' => 'super_admins',
            'hash' => false,
        ],
    ],



    'providers' => [
        'super_admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\SuperAdmin::class,
        ],
        'customers' => [
            'driver' => 'eloquent',
            'model' => App\Models\Customer::class,
        ]
        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],



    'passwords' => [
        'super_admins' => [
            'provider' => 'super_admins',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
        'customers' => [
            'provider' => 'customers',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ]
    ],



    'password_timeout' => 10800,

];
