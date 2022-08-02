<?php
$RouteName = [
    'dashboard.Dindex'
];
if (in_array(request()->route()->getName(), $RouteName)) {
    return;
}
?>
<!--<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-right6 position-left"></i> <span class="text-semibold">Forms</span> - Basic Inputs</h4>
        <a class="heading-elements-toggle"><i class="icon-more"></i></a>
        </div>
    </div>
    <div class="breadcrumb-line breadcrumb-line-component"><a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
        <ul class="breadcrumb">
            <li><a href="{{ route('dashboard.Dindex') }}"><i class="icon-home2 position-left"></i> @lang('Home')</a></li>
            <li class="active">Basic inputs</li>
        </ul>
    </div>
</div>-->
