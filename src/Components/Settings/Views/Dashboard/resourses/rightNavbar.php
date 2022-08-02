<?php

return [
    'title'         => 'Settings',
    'icon'          => 'grid',
    'order'         => 1,
    'permission'    => 'settings',
    'items'         => [
        [
            'title'         => 'General Settings',
            'url'           => route('app.settings.config'),
            'permission'    => 'config'
        ],
        [
            'title'         => 'Socials Settings',
            'url'           => route('app.settings.social'),
            'permission'    => 'social'
        ],
        [
            'title'         => 'Maintenance Mode',
            'url'           => route('app.settings.maintenance'),
            'permission'    => 'maintenance'
        ],
        [
            'title'         => 'Locales',
            'url'           => route('app.settings.locales.index'),
            'permission'    => 'locales'
        ]
    ]
];
