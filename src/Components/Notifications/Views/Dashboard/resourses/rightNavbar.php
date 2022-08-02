<?php

return [
    'title'         => 'Notifications',
    'icon'          => 'grid',
    'order'         => 6,
    'permission'    => 'notifications',
    'items'         => [
        [
            'title'         => 'All Notifications',
            'url'           => route('app.notifications.index'),
            'permission'    => 'view'
        ],
        [
            'title'         => 'Send Notification',
            'url'           => route('app.notifications.create'),
            'permission'    => 'create'
        ],
        [
            'title'         => 'Locales',
            'url'           => route('app.notifications.locales.index'),
            'permission'    => 'locales'
        ]
    ]
];