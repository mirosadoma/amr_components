<?php

return [
    'title'         => 'Banners',
    'icon'          => 'grid',
    'order'         => 7,
    'permission'    => 'banners',
    'items'         => [
        [
            'title'         => 'All Banners',
            'url'           => route('app.banners.index'),
            'permission'    => 'view'
        ],
        [
            'title'         => 'Add New Banner',
            'url'           => route('app.banners.create'),
            'permission'    => 'create'
        ],
        [
            'title'         => 'Locales',
            'url'           => route('app.banners.locales.index'),
            'permission'    => 'locales'
        ]
    ]
];
