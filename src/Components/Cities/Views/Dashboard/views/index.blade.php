@extends('admin.layouts.master')
@section('head_title'){{__('All Cities')}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => [
    [
        'name'  =>  __('Cities'),
        'route' =>  'cities.index',
    ],
],'button' => [
        'title' => __('Add City'),
        'route' =>  'cities.create',
        'icon'  => 'plus'
]])
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
                                    <th>@lang('Name')</th>
                                    <th {!! \table_width_head(6) !!}>@lang('Created At')</th>
                                    <th {!! \table_width_head(5) !!}>@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($lists->count())
                                @foreach ($lists as $item)
                                    <tr>
                                        <td>
                                            <div class="success"></div>
                                            <a href="javascript:;"> {{$item->id}} </a>
                                        </td>
                                        <td> {{$item->name}} </td>
                                        <td> {{$item->created_at->diffForHumans()}} </td>
                                        <td>
                                            @if(permissionCheck('cities.update'))
                                                {!! editForm('cities', $item) !!}
                                            @endif
                                            @if(permissionCheck('cities.delete'))
                                                {!! deleteForm('cities', $item) !!}
                                            @endif
                                            @if(!permissionCheck('cities.update') && !permissionCheck('cities.delete')) ------- @endif
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
