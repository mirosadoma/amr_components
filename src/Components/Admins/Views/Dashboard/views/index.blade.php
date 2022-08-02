@extends('admin.layouts.master')
@section('head_title'){{$PageTitle}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => $Breadcrumb,'button' => $Button??[]])
<div class="content-body">
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
                                    <th {!! \table_width_head(1) !!}>@lang('Role')</th>
                                    <th {!! \table_width_head(6) !!}>@lang('Email')</th>
                                    <th {!! \table_width_head(4) !!}>@lang('Phone')</th>
                                    <th {!! \table_width_head(1) !!}>@lang('Status') </th>
                                    <th {!! \table_width_head(5) !!}>@lang('Created At')</th>
                                    @if(request()->has('type') && request('type') == "deleted")
                                        <th {!! \table_width_head(6) !!}>@lang('Actions')</th>
                                    @else
                                        <th {!! \table_width_head(5) !!}>@lang('Actions')</th>
                                    @endif
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
                                            <td> {{$item->name ?? '-------'}} </td>
                                            <td> {{$item->roles->first()->name ?? '-------'}} </td>
                                            <td> {{$item->email ?? '-------'}} </td>
                                            <td> {{$item->phone_number ?? '-------'}} </td>
                                            <td>
                                                @if($item->is_active == 0)
                                                    <a href="{{route('app.admins.is_active', $item->id)}}" class="label label-sm label-danger" title="{{__('Active Admin')}}"> <i data-feather="x" stroke-width="7" style="color: red;"></i> </a>
                                                @else
                                                    <a href="{{route('app.admins.is_active', $item->id)}}" class="label label-sm label-success" title="{{__('Un Active Admin')}}"> <i data-feather="check" stroke-width="7" style="color: #00b800;"></i> </a>
                                                @endif
                                            </td>
                                            <td> {{$item->created_at->diffForHumans()}} </td>
                                            <td>
                                                @if(permissionCheck('admins.update'))
                                                    {!! editForm('admins', $item) !!}
                                                @endif
                                                @if(permissionCheck('admins.delete'))
                                                    @if(!request()->has('type') || request('type') != "deleted")
                                                        {!! deleteForm('admins', $item) !!}
                                                    @elseif(request()->has('type') && request('type') == "deleted")
                                                        {!! restoreForm('admins', $item) !!}
                                                        {!! destroyForm('admins', $item) !!}
                                                    @endif
                                                @endif
                                                @if(!permissionCheck('admins.update') && !permissionCheck('admins.delete')) ------- @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="no-records-found" style="text-align: center;">
                                        <td colspan="7">@lang('No Data Founded')</td>
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
</div>
@endsection
