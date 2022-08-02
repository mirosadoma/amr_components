<?php

return [
    'title'         => __('Cities'),
    'icon'          => 'fa fa-bar-chart-o',
    'color'         => 'blue',
    'url'           => route('app.cities.index'),
    'permission'    => 'cities',
    'count'         => \App\Components\Cities\Models\City::count()
];