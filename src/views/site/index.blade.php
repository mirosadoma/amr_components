@extends('site.layouts.master')
@section('head_title'){{__('Home')}}@endsection
@section('content')
    @if ($banners->count())
        <!-- start banner slider -->
        <div id="carouselExampleControls" class="carousel slide banner-slider" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($banners as $key => $banner)
                    <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
                        <a href="{{$banner->link??'#'}}">
                            <img src="{{$banner->image_path}}" class="d-block w-100" alt="{{$banner->image_path}}">
                        </a>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">@lang("Previous")</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">@lang("Next")</span>
            </button>
        </div>
        <!-- end banner slider -->
    @endif
    <!-- start prize -->
    <section class="prize" >
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="prize-info">
                        <h2 class="prize-title title_section"> @lang("Grand prize") </h2>
                        <p> يمكنك ادراج في تلك المساحة ملخص عن الجائزة الكبرى ذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.ذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق. </p>
                        <div class="prize-animate">
                            <img src="{{asset('assets')}}/site/images/Path-4829.png" class="path_two" alt="{{asset('assets')}}/site/images/Path-4829.png">
                            <img src="{{asset('assets')}}/site/images/freepik--Confetti--inject-10.png" class="dots" alt="{{asset('assets')}}/site/images/freepik--Confetti--inject-10.png">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="prize-img">
                        <img src="{{asset('assets')}}/site/images/61153-trophy-congratulation.gif" alt="{{asset('assets')}}/site/images/61153-trophy-congratulation.gif">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push("scripts")
    <script>
        $(document).ready(function () {
            var image = "url('"+$('#be-egaby').attr('data-image')+"')";
            $('#be-egaby').css("background-image", image);
        });
    </script>
@endpush
