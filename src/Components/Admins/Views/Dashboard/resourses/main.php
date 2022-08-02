<?php

return [
    'title'         => __('Admins'),
    'icon'          => 'fa fa-bar-chart-o',
    'color'         => 'blue',
    'url'           => route('app.admins.index'),
    'permission'    => 'admins',
    'count'         => \App\Models\User::where('type', 'admin')->where('id', '<>', 1)->count()
];
