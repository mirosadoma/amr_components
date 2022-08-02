<!-- Default Breadcrumb Starts -->
<section id="default-breadcrumb">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <nav aria-label="breadcrumb" style="display: inline-block">
                        <ol class="breadcrumb">
                            @if (!empty($array))
                                <li class="breadcrumb-item">
                                    <a href="{{ route('app.dashboard') }}"><i class="icon-home"></i> @lang('Home')</a>
                                    {{-- <i class="fa fa-circle"></i> --}}
                                </li>
                                <?php
                                    $arrayCount = count($array);
                                    $count      = 1;
                                ?>
                                @foreach ($array as $item)
                                    @if ($arrayCount == $count)
                                        <li class="breadcrumb-item active">{{ $item['name'] }}</li>
                                    @else
                                        @if (is_array($item['route']))
                                            <li class="breadcrumb-item"><a href="{{ route('app.'.$item['route'][0],array_slice($item['route'],1)) }}">{{ $item['name'] }}</a>
                                                {{-- <i class="fa fa-circle"></i> --}}
                                            </li>
                                        @else
                                            <li class="breadcrumb-item"><a href="{{ route('app.'.$item['route']) }}">{{ $item['name'] }}</a>
                                                {{-- <i class="fa fa-circle"></i> --}}
                                            </li>
                                        @endif
                                    @endif
                                    <?php  $count++; ?>
                                @endforeach
                            @else
                                <li class="breadcrumb-item active"><i class="icon-home"></i> @lang('Home')</li>
                            @endif
                        </ol>
                    </nav>
                    @if (isset($button) && is_array($button) && !isset($button['route']))
                        @foreach($button as $value)
                            @if (!empty($value))
                                @if(is_array($value['route']))
                                    <?php $route =  route('app.'.$value['route'][0],$value['route'][1])?>
                                @else
                                    <?php $route =  route('app.'.$value['route'])?>
                                @endif
                                <a href="{{$route}}" class="btn btn-primary btn-round waves-effect waves-float waves-light button_in_navbar" style="margin-right: 10px;" title="{{$value['title']}}">{{$value['title']}} <i data-feather="{{$value['icon']}}"></i></a>
                            @endif
                        @endforeach
                    @else
                        @if (isset($button) && !empty($button))
                            @if(is_array($button['route']))
                                <?php $route =  route('app.'.$button['route'][0],$button['route'][1])?>
                            @else
                                <?php $route =  route('app.'.$button['route'])?>
                            @endif
                            <a href="{{$route}}" class="btn btn-primary btn-round waves-effect waves-float waves-light button_in_navbar" title="{{$button['title']}}">{{$button['title']}} <i data-feather="{{$button['icon']}}"></i></a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Default Breadcrumb Ends -->

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
