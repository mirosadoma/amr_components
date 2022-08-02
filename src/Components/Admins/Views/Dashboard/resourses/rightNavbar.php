<?php

return [
    'title'         => 'Admins',
    'icon'          => 'grid',
    'order'         => 2,
    'permission'    => 'admins',
    'items'         => [
        [
            'title'         => 'All Admins',
            'url'           => route('app.admins.index'),
            'permission'    => 'view'
        ],
        [
            'title'         => 'Activations',
            'url'           => route('app.admins.index').'?type=active',
            'permission'    => 'view'
        ],
        [
            'title'         => 'Un Activations',
            'url'           => route('app.admins.index').'?type=unactive',
            'permission'    => 'view'
        ],
        [
            'title'         => 'Deleted',
            'url'           => route('app.admins.index').'?type=deleted',
            'permission'    => 'view'
        ],
        [
            'title'         => 'Add New Admin',
            'url'           => route('app.admins.create'),
            'permission'    => 'create'
        ],
        [
            'title'         => 'Locales',
            'url'           => route('app.admins.locales.index'),
            'permission'    => 'locales'
        ]
    ]
];
