<?php

return [
    'title'         => __('Roles'),
    'icon'          => 'fa fa-bar-chart-o',
    'color'         => 'blue',
    'url'           => route('app.roles.index'),
    'permission'    => 'roles',
    'count'         => \Spatie\Permission\Models\Role::where('guard_name', 'admin')->where('id', '<>', 1)->count()
];