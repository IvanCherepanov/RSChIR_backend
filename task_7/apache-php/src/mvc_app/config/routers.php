<?php
// All routers
return [
    'admin' => [
        'controller' => 'admin',
        'action' => 'users'
    ],
    'admin/api' => [
        'controller' => 'admin',
        'action' => 'api'
    ],
    'product' => [
        'controller' => 'product',
        'action' => 'products'
    ],

    'product/api' => [
        'controller' => 'product',
        'action' => 'api'
    ],
    'statistics' => [
        'controller' => 'statistics',
        'action' => 'show'
    ],
];