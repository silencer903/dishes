<?php
return [
    'login' => [
        'type' => 2,
    ],
    'logout' => [
        'type' => 2,
    ],
    'error' => [
        'type' => 2,
    ],
    'index' => [
        'type' => 2,
    ],
    'view' => [
        'type' => 2,
    ],
    'update' => [
        'type' => 2,
    ],
    'create' => [
        'type' => 2,
    ],
    'delete' => [
        'type' => 2,
    ],
    'finddishesforuser' => [
        'type' => 2,
    ],
    'dishes' => [
        'type' => 2,
    ],
    'ingredients' => [
        'type' => 2,
    ],
    'site' => [
        'type' => 2,
    ],
    'guest' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'site',
            'login',
            'logout',
            'error',
            'view',
        ],
    ],
    'user' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'index',
            'finddishesforuser',
            'guest',
        ],
    ],
    'admin' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'delete',
            'dishes',
            'update',
            'create',
            'ingredients',
            'guest',
        ],
    ],
];
