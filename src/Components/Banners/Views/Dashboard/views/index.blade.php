@extends('admin.layouts.master')
@section('head_title'){{__('All Banners')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => $Breadcrumb,'button' => $Button??[]])
<div class="content-body">
    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">@lang('General Settings')</h4>
                    </div>
                    <!--Search Form -->
                    @include('INPUTS::search',["search"=>$search])
                    <!--Search Form -->
                    <div class="card-body table-responsive">
                        <table class="table datatable-basic">
                            <thead>
                                <tr>
                                    <th {!! \table_width_head(1) !!}>#</th>
                                    <th>@lang('Image')</th>
                                    <th {!! \table_width_head(7) !!}>@lang('Link')</th>
                                    <th {!! \table_width_head(1) !!}>@lang('Status') </th>
                                    <th {!! \table_width_head(6) !!}>@lang('Created At')</th>
                                    <th {!! \table_width_head(5) !!}>@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($lists->count())
                                @foreach ($lists as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td> <img src="{{$item->image_path}}" alt="{{$item->image_path}}" width="120" height="80"> </td>
                                        <td> {{$item->link??"-----"}} </td>
                                        <td>
                                            @if($item->is_active == 0)
                                                <a href="{{route('app.banners.is_active', $item->id)}}" class="label label-sm label-danger" title="{{__('Active Banner')}}"> <i data-feather="x" stroke-width="7" style="color: red;"></i> </a>
                                            @else
                                                <a href="{{route('app.banners.is_active', $item->id)}}" class="label label-sm label-success" title="{{__('Un Active Banner')}}"> <i data-feather="check" stroke-width="7" style="color: #00b800;"></i> </a>
                                            @endif
                                        </td>
                                        <td> {{$item->created_at->diffForHumans()}} </td>
                                        <td>
                                            @if(permissionCheck('banners.update'))
                                                {!! editForm('banners', $item) !!}
                                            @endif
                                            @if(permissionCheck('banners.delete'))
                                                {!! deleteForm('banners', $item) !!}
                                            @endif
                                            @if(!permissionCheck('banners.update') && !permissionCheck('banners.delete')) ------- @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="no-records-found" style="text-align: center;">
                                    <td colspan="4">@lang('No Data Founded')</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <!-- start pagination -->
                        <div class="pagination-section">
                            <div class="container">
                                {!! $lists->links() !!}
                            </div>
                        </div>
                        <!-- start pagination -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Advanced Search -->
</div>
@endsection
