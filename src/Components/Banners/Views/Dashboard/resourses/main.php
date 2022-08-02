<?php

return [
    'title'         => __('Banners'),
    'icon'          => 'fa fa-bar-chart-o',
    'color'         => 'blue',
    'url'           => route('app.banners.index'),
    'permission'    => 'banners',
    'count'         => \App\Components\Banners\Models\Banner::count()
];
