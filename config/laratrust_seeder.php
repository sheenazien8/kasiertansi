<?php

return [
    'role_structure' => [
        'superadmin' => [
            'categories' => 'r',
            'items' => 'r',
            'units' => 'r',
            'acl' => 'c,r,u,d',
        ],
        'owner' => [
            'categories' => 'c,r,u,d',
            'items' => 'c,r,u,d',
            'units' => 'c,r,u,d',
            'users' => 'c,r,u,d',
            'acl' => 'c,r,u,d',
        ],
        'employee' => [
            'categories' => 'c,r,u,d',
            'items' => 'c,r,u,d',
            'units' => 'c,r,u,d',
            'users' => 'c,r,u,d',
            'acl' => 'c,r,u,d',
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
