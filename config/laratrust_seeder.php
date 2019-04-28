<?php

return [
    'role_structure' => [
        'superadmin' => [
            'categories' => 'c,r,u,d',
            'items' => 'c,r,u,d',
            'purchasing' => 'c,r,u,d',
            'selling' => 'c,r,u,d',
            'cashier' => 'c,r,u,d',
            'purchase_order' => 'c,r,u,d',
            'unit' => 'c,r,u,d',
            'supplier' => 'c,r,u,d',
            'manage_permission' => 'c,r,u,d',
            'employee' => 'c,r,u,d',
            'report' => 'c,r,u,d',
            'spending' => 'c,r,u,d',
            'income' => 'c,r,u,d',
            'master' => 'c,r,u,d',
            'user' => 'c,r,u,d',
            'dashboard' => 'c,r,u,d',
        ],
        'owner' => [
            'categories' => 'c,r,u,d',
            'items' => 'c,r,u,d',
            'purchasing' => 'c,r,u,d',
            'selling' => 'c,r,u,d',
            'cashier' => 'c,r,u,d',
            'purchase_order' => 'c,r,u,d',
            'unit' => 'c,r,u,d',
            'supplier' => 'c,r,u,d',
            'manage_permission' => 'c,r,u,d',
            'employee' => 'c,r,u,d',
            'report' => 'c,r,u,d',
            'spending' => 'c,r,u,d',
            'income' => 'c,r,u,d',
            'master' => 'c,r,u,d',
            'user' => 'c,r,u,d',
            'dashboard' => 'c,r,u,d',
        ],
        'employee' => [
            'items' => 'r',
            'cashier' => 'c,r,u,d',
            'dashboard' => 'c,r,u,d'
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
