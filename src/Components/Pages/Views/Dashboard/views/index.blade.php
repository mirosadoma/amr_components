@extends('admin.layouts.master')
@section('head_title'){{__('All Pages')}}@endsection
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
                                    <th>@lang('Title')</th>
                                    <th {!! \table_width_head(1) !!}>@lang('Status') </th>
                                    <th {!! \table_width_head(5) !!}>@lang('Created At')</th>
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
                                        <td> {{$item->title}} </td>
                                        <td>
                                            @if($item->is_active == 0)
                                                <a href="{{route('app.pages.active_page', $item->id)}}" class="label label-sm label-danger" title="{{__('Active Page')}}"> <i data-feather="x" stroke-width="7" style="color: red;"></i> </a>
                                            @else
                                                <a href="{{route('app.pages.active_page', $item->id)}}" class="label label-sm label-success" title="{{__('Un Active Page')}}"> <i data-feather="check" stroke-width="7" style="color: #00b800;"></i> </a>
                                            @endif
                                        </td>
                                        <td> {{$item->created_at->diffForHumans()}} </td>
                                        <td>
                                            @if(permissionCheck('pages.update'))
                                                {!! editForm('pages', $item) !!}
                                            @endif
                                            @if(permissionCheck('pages.delete'))
                                                @if ($item->is_delete == 1)
                                                    {!! deleteForm('pages', $item) !!}
                                                @endif
                                            @endif
                                            @if(!permissionCheck('pages.update') && !permissionCheck('pages.delete')) ------- @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="no-records-found" style="text-align: center;">
                                    <td colspan="5">@lang('No Pages Found')</td>
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
