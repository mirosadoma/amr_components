<?php

return [
    'title'         => 'Clients',
    'icon'          => 'grid',
    'order'         => 3,
    'permission'    => 'clients',
    'items'         => [
        [
            'title'         => 'All Clients',
            'url'           => route('app.clients.index'),
            'permission'    => 'view'
        ],
        [
            'title'         => 'Activations',
            'url'           => route('app.clients.index').'?type=active',
            'permission'    => 'view'
        ],
        [
            'title'         => 'Un Activations',
            'url'           => route('app.clients.index').'?type=unactive',
            'permission'    => 'view'
        ],
        [
            'title'         => 'Deleted',
            'url'           => route('app.clients.index').'?type=deleted',
            'permission'    => 'view'
        ],
        [
            'title'         => 'Add New Client',
            'url'           => route('app.clients.create'),
            'permission'    => 'create'
        ],
        [
            'title'         => 'Locales',
            'url'           => route('app.clients.locales.index'),
            'permission'    => 'locales'
        ]
    ]
];
