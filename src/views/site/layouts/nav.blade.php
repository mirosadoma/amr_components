<!-- start nabar -->
<nav class="navbar @if(\Route::currentRouteName() != "home") navbar-inside @endif">
    <div class="container">
        <a href="{{route('home')}}" class="nav-logo"> 
            <img src="{{app_settings()->logo_path}}" alt="{{app_settings()->logo_path}}" class="logo">
        </a>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="{{route('home')}}" class="nav-link @if(\Route::currentRouteName() == "home") active @endif">@lang("Home")</a>
            </li>
            @if(\Auth::check())
                <ol>
                    <li class="nav-item profile">
                        <div class="dropdown profile-dropdown">
                            <button class="profile-toggle dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{asset('assets')}}/site/images/Group-8704.png" alt="{{asset('assets')}}/site/images/Group-8704.png">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                @if (\Auth::user()->type == "client" || \Auth::user()->type == "positive")
                                    <li><a class="dropdown-item" href="{{route('profile.index')}}"> @lang("My Profile Settings") </a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{route('site.logout')}}"> @lang("LogOut") </a></li>
                            </ul>
                        </div>
                        @if (\Auth::user()->type == "client" && \Auth::user()->finished_cource == 1)
                            <div class="badge-finish">
                                <img src="{{asset('assets')}}/site/images/Group-9216.png" alt="" width="50" height="50">
                            </div>
                        @endif
                    </li>
                </ol>
            @endif
        </ul>
        <div class="hamburger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </div>
</nav>
<!-- end nabar -->