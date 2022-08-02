<?php

return [
    'title'         => __('Pages'),
    'icon'          => 'fa fa-bar-chart-o',
    'color'         => 'blue',
    'url'           => route('app.pages.index'),
    'permission'    => 'pages',
    'count'         => \App\Components\Pages\Models\Page::count()
];