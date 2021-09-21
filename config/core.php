<?php

return [
    'routeNamePrefix' => config('app.adminRouteNamePrefix', 'admin.'),
    'exports' => [
        'users' => [
            'exportColumns' => [
                "name",
                "last_name",
                "email",
                "is_active",
                "created_at",
                "updated_at",
            ]
        ],
    ],
    'imports' => [
        'users' => [
            'columnMapping' => [
                "name" => 'A',
                "last_name" => 'B',
                "email" => 'C'
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
        
    ],
    'displayFields' => [
        'users' => [
            'name',
            'last_name',
            'email',
            'is_active',
            'created_at',
            'updated_at'
        ]
    ]
];
