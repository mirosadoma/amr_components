<?php

return [
    'title'         => __('ContactUs'),
    'icon'          => 'fa fa-bar-chart-o',
    'color'         => 'blue',
    'url'           => route('app.contactus.index'),
    'permission'    => 'contact_us',
    'count'         => \App\Components\ContactUs\Models\ContactUs::count()
];