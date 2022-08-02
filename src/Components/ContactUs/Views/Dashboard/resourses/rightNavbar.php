<?php

return [
    'title'         => 'ContactUs',
    'icon'          => 'grid',
    'order'         => 8,
    'permission'    => 'contact_us',
    'items'         => [
        [
            'title'         => 'All ContactUs',
            'url'           => route('app.contactus.index'),
            'permission'    => 'view'
        ],
        [
            'title'         => 'Locales',
            'url'           => route('app.contactus.locales.index'),
            'permission'    => 'locales'
        ]
    ]
];