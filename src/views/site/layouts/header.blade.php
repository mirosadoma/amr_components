<!-- start header -->
<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="header-info">
                    <h6> @lang("Initiative") </h6>
                    <h5> @lang("I'm positive") </h5>
                    <p> @lang("Our target is emphasizing the role of community positivity, achieving this by linking between community needs and positive people, and by implementing different methodologies and tools that match the targeted audience of the initiative, which are students and young as the main target audience.") </p>
                    @if(!\Auth::check())
                        <div class="header-btns">
                            <a href="{{url('login')}}" class="button_custom"> @lang("Sign in") </a>
                            <a href="{{url('signup')}}" class="button_custom button_custom_sec"> @lang("Sign up") </a>                          
                        </div>
                    @endif
                    <div class="header-animate">
                        <img src="{{asset('assets')}}/site/images/arrow.gif" class="arrow" alt="{{asset('assets')}}/site/images/arrow.gif">
                        <img src="{{asset('assets')}}/site/images/sun.gif" class="sun" alt="{{asset('assets')}}/site/images/sun.gif">
                        <img src="{{asset('assets')}}/site/images/line.gif" class="path" alt="{{asset('assets')}}/site/images/line.gif">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="header-img">
                    <img src="{{asset('assets')}}/site/images/box2.gif" alt="{{asset('assets')}}/site/images/box2.gif" >
                </div>
            </div>
            <div class="col-12">
                <div class="scroll-down mt-5">
                    <ul>
                        <li> <a href="#be-egaby"> <i class="fas fa-angle-down"></i> </a>  </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- end header -->