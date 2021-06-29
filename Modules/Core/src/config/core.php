<?php

return [
    'routeNamePrefix' => config('app.adminRouteNamePrefix', 'admin.'),
    'exports' => [
        'users' => [
            'exportColumns' => [
                "username",
                "name",
                "last_name",
                "email",
                "phone",
                "address",
                "address2",
                "city",
                "state",
                "zipCode",
                "is_active",
                "timezone",
                "created_at",
                "updated_at",
            ]
        ],
    ],
    'imports' => [
        'users' => [
            'columnMapping' => [
                "username" => 'A',
                "name" => 'B',
                "last_name" => 'C',
                "email" => 'D',
                "phone" => 'E',
                "address" => 'F',
                "address2" => 'G',
                "city" => 'H',
                "state" => 'I',
                "zipCode" => 'J',
            ],
            'defaults' => [
                "created_at" => now(),
                "updated_at" => now(),
            ],
            'hash' => [
                'password' => '12345678',
            ]
        ],
    ],
    'other-permissions' => [
        
    ]
];
