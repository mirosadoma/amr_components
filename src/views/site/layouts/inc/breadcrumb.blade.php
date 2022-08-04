<div class="navigation-bread">
    <div class="navigation-overlay"> 
<div class="container">
<section class="content">
@if (isset($title) && !empty($title))
<h1 data-aos="fade-left" data-aos-duration="2000">{{$title}}</h1>
@endif
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
@if (!empty($array))
<li class="breadcrumb-item">
<a href="{{ route('home') }}"><i class="icon-home"></i> @lang('Home')</a>
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
<li class="breadcrumb-item"><a href="{{ route($item['route'][0],array_slice($item['route'],1)) }}">{{ $item['name'] }}</a>
</li>
@else
<li class="breadcrumb-item"><a href="{{ route($item['route']) }}">{{ $item['name'] }}</a>
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
</section>
</div>
</div>
</div>