<!-- start footer -->
<footer>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-3 col-md-6">
                <div class="footer-desc mb-5">
                    <a href="{{route('home')}}" class="nav-logo">
                        <img src="{{app_settings()->footer_logo_path}}" alt="{{app_settings()->footer_logo_path}}" class="logo">
                    </a>
                    {{-- <h2> اللوجو </h2> --}}
                    <p> @lang("We also aim for building strategic partnerships with educational institutions, government agencies related to youth; to achieve its goals and qualitative rules.") </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-links mb-5">
                    <h3> @lang("The Initiative") </h3>
                    <ul>
                        @foreach(\App\Components\Pages\Models\Page::where('is_active', 1)->get() as $page)
                            @if ($page->slug)
                                <?php $slug = $page->slug; ?>
                            @else
                                <?php $slug = $page->id; ?>
                            @endif
                            <li> <a href="{{route('pages.show', $slug)}}"> {{$page->title}} </a> </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-links mb-5">
                    <h3> @lang("Important links") </h3>
                    <ul>
                        @if(!\Auth::check())
                            <li> <a href="{{route('site.login')}}"> @lang("Sign in") </a>
                            <a href="{{route('site.signup')}}"> / @lang("Sign up") </a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-links mb-5">
                    <h3> @lang("Contact Us") </h3>
                    <ul>
                        <li> <a href="tel:{{app_settings()->phone_number??''}}"> <i class="fas fa-phone"></i> {{app_settings()->phone_number??''}}  </a> </li>
                        <li> <a href="mailto:{{app_settings()->email??''}}"> <i class="fas fa-envelope"></i> {{app_settings()->email??''}}  </a> </li>
                    </ul>
                    <ul class="social">
                    @foreach (\App\Components\Settings\Models\SiteSocial::all() as $social)
                        <li> <a href="{{$social->value}}" target="_blank"> <i class="fab fa-{{$social->class}}"></i> </a> </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @if (!\Auth::check())
        <div class="sticky-btns">
            <a href="{{route('site.login')}}" title="{{__('Sign in')}}"><i class="fas fa-door-closed"></i> </a>
        </div>
    @endif
</footer>
<div class="copy-right">
    <p> حقوق الملكية لدى &copy; <a href="http://moltaqa.net/" translate="no"> ملتقى للبرمجيات </a> </p>
</div>
<!-- end footer -->
