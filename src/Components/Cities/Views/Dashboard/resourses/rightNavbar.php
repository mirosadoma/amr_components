<?php

return [
    'title'         => 'Cities',
    'icon'          => 'grid',
    'order'         => 7,
    'permission'    => 'cities',
    'items'         => [
        [
            'title'         => 'All Cities',
            'url'           => route('app.cities.index'),
            'permission'    => 'view'
        ],
        [
            'title'         => 'Add New City',
            'url'           => route('app.cities.create'),
            'permission'    => 'create'
        ],
        [
            'title'         => 'Locales',
            'url'           => route('app.cities.locales.index'),
            'permission'    => 'locales'
        ]
    ]
];