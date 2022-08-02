<?php

return [
    'title'         => 'Roles',
    'icon'          => 'grid',
    'order'         => 4,
    'permission'    => 'roles',
    'items'         => [
        [
            'title'         => 'All Roles',
            'url'           => route('app.roles.index'),
            'permission'    => 'view'
        ],
        [
            'title'         => 'Add New Role',
            'url'           => route('app.roles.create'),
            'permission'    => 'create'
        ],
        [
            'title'         => 'Locales',
            'url'           => route('app.roles.locales.index'),
            'permission'    => 'locales'
        ]
    ]
];