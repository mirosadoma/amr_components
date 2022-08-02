@extends('site.layouts.master')
@section('head_title'){{__('Notifications')}}@endsection
@section('content')
    <!-- start notification -->
    <div class="notification">
        <div class="container">
            <div class="notification-item">
                @forelse ($allNotifications as $notification)
                    <div>
                        <div class="notification-date"> {{$notification->created_at->toDateString()}} </div>
                        <span class="circle"><i class="far fa-circle"></i></span>
                        <img class="notification-img" src="{{\Auth::user()->image_path}}" alt="{{\Auth::user()->image_path}}">
                        <p class="notification-info">
                            @if ($notification->data['url'] != "home/")
                                <a href="{{url($notification->data['url'])}}">{{$notification->data[app()->getLocale()]}} </a>
                            @else
                                {{$notification->data[app()->getLocale()]}}
                            @endif
                            </p>
                            
                        <span class="notification-clock"> {{getMyDateZone($notification->created_at)->format("h:i")}} {{__(getMyDateZone($notification->created_at)->format("a"))}} </span>
                    </div>
                @empty
                    <div class="initiatives">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="no-initatives">
                                        <img src="{{asset('assets')}}/site/images/872-empty-list.png" alt="{{asset('assets')}}/site/images/872-empty-list.png">
                                        <h3>@lang("No Data Found")</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- end notification -->
@endsection