<div class="sidebar-category sidebar-category-visible">
    <div class="category-content no-padding">
        <ul class="navigation navigation-main navigation-accordion">
            <li class="navigation-header"><input type="text" placeholder="@lang('Search in menu')"></li>
            <li><a href="{{ route('dashboard.Dindex') }}"><i class="icon-home4"></i> <span>@lang('Dashboard')</span></a></li>
            {!! AdminMenu() !!}
        </ul>
    </div>
</div>