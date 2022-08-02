<?php

return [
    'title'         => __('Notifications'),
    'icon'          => 'fa fa-bar-chart-o',
    'color'         => 'blue',
    'url'           => route('app.notifications.index'),
    'permission'    => 'notifications',
    'count'         => \Auth::guard('admin')->user()->unreadNotifications->count()
];