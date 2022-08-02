<?php

return [
    'title'         => __('Clients'),
    'icon'          => 'fa fa-bar-chart-o',
    'color'         => 'blue',
    'url'           => route('app.clients.index'),
    'permission'    => 'clients',
    'count'         => \App\Models\User::where('type', 'client')->count()
];