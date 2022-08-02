<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl {{app_settings()->is_dark == 1 ? 'navbar-dark' : 'navbar-light'}}">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link bookmark-star spinner"><i class="ficon text-warning" data-feather="star"></i></a>
                    <div class="bookmark-input ">
                        <div class="bookmark-input-icon"></div>
                        <ul class="nav navbar-nav bookmark-icons">
                            @foreach (getTopNavbar() as $top)
                                @if (admin_can_any($top['permission']) == "true")
                                    <li class="nav-item d-none d-lg-block" style="padding: 10px">
                                        <a class="nav-link" href="{{$top['url']}}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$top['title']}}">
                                            <i class="ficon" data-feather="{{$top['icon']}}"></i>
                                            <span class="ficon">{{$top['title']}}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ms-auto">
            @if(app()->getLocale() != "en")
                <p>{{count(trans()->notTranslated)}}</p>
                <li class="nav-item d-none d-lg-block translate" data-toggle="modal" data-target="#translation" title="{{__('Translation')}}">
                    <a href="javascript:void(0)" class="nav-link">
                        <i class="ficon" data-feather="repeat"></i>
                    </a>
                </li>
            @endif
            <li class="nav-item dropdown dropdown-language">
                <a class="nav-link dropdown-toggle spinner" id="dropdown-flag" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ficon" data-feather="globe"></i><span class="selected-language"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag">
                    @forelse (config('laravellocalization.supportedLocales') as $item => $value)
                        <a class="dropdown-item {{ (app()->getLocale() == $item) ? 'active' : ''}}" href="{{LaravelLocalization::getLocalizedURL($item)}}" data-language="{{$item}}">@lang($value['name'])</a>
                    @empty
                    @endforelse
                </div>
            </li>
            <li class="nav-item d-none d-lg-block moon_ajax"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
            {{-- <li class="nav-item nav-search">
                <a class="nav-link nav-link-search">
                    <i data-feather="search" style="width: 21px;height: 21px;"></i>
                </a>
                <div class="search-input">
                    <div class="search-input-icon">
                        <i data-feather="search"></i>
                    </div>
                    <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="-1" data-search="search">
                    <div class="search-input-close">
                        <i data-feather="x"></i>
                    </div>
                    <ul class="search-list search-list-main ps">

                        <li class="auto-suggestion">
                            <a class="d-flex align-items-center justify-content-between w-100" href="https://pixinvent.com/demo/vuexy-bootstrap-laravel-admin-template/demo-1/dashboard/analytics">
                                <div class="d-flex justify-content-start align-items-center">
                                    <span>Analytics Dashboard</span>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>
            </li> --}}
            <li class="nav-item dropdown dropdown-notification me-25">
                <a class="nav-link" href="#" data-bs-toggle="dropdown">
                    @if(Auth::guard('admin')->user()->unreadNotifications()->count())
                        <i class="ficon" data-feather="bell"></i>
                        <span class="badge rounded-pill bg-danger badge-up">{{ Auth::guard('admin')->user()->unreadNotifications()->count() }}</span>
                    @else
                        <i class="ficon" data-feather="bell-off"></i>
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 me-auto">@lang("Notifications")</h4>
                            @if(Auth::guard('admin')->user()->unreadNotifications()->count())
                                <div class="badge rounded-pill badge-light-primary">{{ Auth::guard('admin')->user()->unreadNotifications()->count() }} @lang("New")</div>
                            @endif
                        </div>
                    </li>
                    <li class="scrollable-container media-list">
                        @forelse(Auth::guard('admin')->user()->unreadNotifications()->latest()->take(5)->get() as $key => $one)
                            <a class="d-flex" href="{{ route('app.notifications.show' , [$one->id]) }}">
                                <div class="list-item d-flex align-items-start">
                                    <div class="me-1">
                                        <div class="avatar">
                                            <img src="admin/app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" width="32" height="32">
                                        </div>
                                    </div>
                                    <div class="list-item-body flex-grow-1">
                                        <p class="media-heading"><span class="fw-bolder">{{ $one->data[app()->getLocale()] }}</span></p>
                                        <small class="notification-text">{{ $one->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="alert alert-danger text-center">@lang("No Notifications New ....")</div>
                            <li class="dropdown-menu-footer"><a class="btn btn-primary w-100" href="{{ route('app.notifications.index') }}">@lang("All Notifications")</a></li>
                        @endforelse
                    </li>
                    @if(Auth::guard('admin')->user()->unreadNotifications()->count())
                        <li class="dropdown-menu-footer"><a class="btn btn-primary w-100" href="{{ route('app.markAllAsRead') }}">@lang("Mark All As Read")</a></li>
                    @endif
                </ul>
            </li>
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder">{{\Auth::guard('admin')->user()->name}}</span><span class="user-status">{{\Auth::guard('admin')->user()->roles->count() ? __(ucwords(\Auth::guard('admin')->user()->roles->first()->name)) : ''}}</span></div><span class="avatar"><img class="round" src="{{!is_null(\Auth::guard('admin')->user()->image) ? url(\Auth::guard('admin')->user()->image) : 'admin/app-assets/images/portrait/small/avatar-s-11.jpg' }}" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="{{route('app.admins.edit', \Auth::guard('admin')->user()->id)}}"><i class="me-50" data-feather="user"></i> @lang("My Profile")</a>
                    <a class="dropdown-item" href="{{route('app.notifications.index')}}"><i class="me-50" data-feather="bell"></i> @lang("Notifications")</a>
                    <a class="dropdown-item" href="{{url('/')}}" target="_blank"><i class="me-50" data-feather="credit-card"></i> @lang("Site")</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{url('app/logout')}}"><i class="me-50" data-feather="power"></i> @lang("Log Out")</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
