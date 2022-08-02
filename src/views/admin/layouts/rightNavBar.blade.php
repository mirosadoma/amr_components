<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
    <li class="nav-item {{ \Route::currentRouteName() == "app.dashboard" ? 'active' : '' }}">
        <a href="{{route('app.dashboard')}}" class="d-flex align-items-center">
            <i data-feather="home"></i>
            <span class="menu-title text-truncate" data-i18n="{{__('Main')}}">@lang('Main')</span>
        </a>
    </li>
    <div class="navigation-header" style="padding: 0px 12px;margin: 10px 0;">
        <input class="form-control" type="text" placeholder="{{ __("Search In Right SideBar !") }}" style=" width: 100%;margin-bottom: 15px;font-family: 'Cairo', sans-serif !important;font-size: 1.1rem;font-weight: 400;">
    </div>
    @foreach (getRightNavbar() as $nav)
        @if (admin_can_any($nav['permission']) == "true")
            @if (isset($nav['items']) && !empty($nav['items']))
                <li class="nav-item {{ strpos(URL::full(), strtolower($nav['title'])) !== false ? 'active open' : '' }}">
                    <a href="javascript:;" class="d-flex align-items-center" title="@lang($nav['title'])">
                        <i data-feather="{{$nav['icon']}}"></i>
                        <span class="menu-title text-truncate" data-i18n="{{__($nav['title'])}}">@lang($nav['title'])</span>
                    </a>
                    <ul class="menu-content">
                        @foreach ($nav['items'] as $item)
                            @if (admin_can_item($nav['permission'], $item['permission']) == "true")
                                <li>
                                    <a class="d-flex align-items-center" href="{{$item['url']}}" title="@lang($item['title'])">
                                        <i data-feather="circle"></i>
                                        <span class="menu-item text-truncate" data-i18n="List">@lang($item['title'])</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @else
                @if(empty($nav['items']) && isset($nav['url']))
                    <li class="nav-item {{ strpos(URL::full(), strtolower($nav['title'])) !== false ? 'active open' : '' }}">
                        <a href="{{$nav['url']}}" class="d-flex align-items-center">
                            <i data-feather="{{$nav['icon']}}"></i>
                            <span class="menu-title text-truncate" data-i18n="{{__($nav['title'])}}">@lang($nav['title'])</span>
                        </a>
                    </li>
                @endif
            @endif
        @endif
    @endforeach
</ul>

