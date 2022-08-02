<?php

return [
    'title'         => 'General Locales',
    'icon'          => 'grid',
    'order'         => 9,
    'permission'    => 'locales',
    'items'         => [
        [
            'title'         => 'All General Locales',
            'url'           => route('app.locales.index'),
            'permission'    => 'view'
        ]
    ]
];
