<?php

return [
    'title'         => 'Pages',
    'icon'          => 'grid',
    'order'         => 5,
    'permission'    => 'pages',
    'items'         => [
        [
            'title'         => 'All Pages',
            'url'           => route('app.pages.index'),
            'permission'    => 'view'
        ],
        [
            'title'         => 'Add New Page',
            'url'           => route('app.pages.create'),
            'permission'    => 'create'
        ],
        [
            'title'         => 'Locales',
            'url'           => route('app.pages.locales.index'),
            'permission'    => 'locales'
        ]
    ]
];