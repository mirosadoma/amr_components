@extends('admin.layouts.master')
@section('head_title'){{$PageTitle}}@endsection
@section('content')
@include('admin.layouts.inc.breadcrumb', ['array' => $Breadcrumb,'button' => $Button??[]])
@push('styles')
    <style>
    a.btn.btn-success.btn-round.waves-effect.waves-float.waves-light.mr-auto {
        margin-right: auto !important;
    }
    a.btn.btn-danger.btn-round.waves-effect.waves-float.waves-light {
        margin-right: 10px !important;
    }
    </style>
@endpush
<div class="content-body">
    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">@lang('Basic information')</h4>
                        @if(Auth::guard('admin')->user()->unreadNotifications()->count())
                            <a href="{{ route('app.markAllAsRead') }}" class="btn btn-success btn-round waves-effect waves-float waves-light mr-auto"> @lang("Mark all as read") <i class="mdi mdi-check-all"></i></a>
                        @endif
                        @if(Auth::guard('admin')->user()->notifications()->count())
                            <a href="{{ route('app.destroyAll') }}" class="btn btn-danger btn-round waves-effect waves-float waves-light"> @lang("Delete all") <i class="fas fa-trash"></i></a>
                        @endif
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table datatable-basic">
                            <thead>
                                <tr>
                                    <th {!! \table_width_head(1) !!}>#</th>
                                    <th>@lang('Title')</th>
                                    <th {!! \table_width_head(4) !!}>@lang('Status')</th>
                                    <th {!! \table_width_head(5) !!}>@lang('Created At')</th>
                                    <th {!! \table_width_head(1) !!}>@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($allNotifications as $key => $one)
                                    <tr>
                                        <td>
                                            <div class="success"></div>
                                            <a href="javascript:;"> {{$key+1}} </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('app.notifications.show' , [$one->id]) }}" class="m-b-0 font-medium p-0">{{ $one->data['ar'] }}</a>
                                        </td>
                                        <td>
                                            @if($one->read() == 1)
                                                <span class="badge rounded-pill badge-light-success me-1">@lang("Read")</span>
                                            @else
                                                <a href="{{route('app.notifications.update_status', $one->id)}}"><span class="badge rounded-pill badge-light-danger me-1">@lang("Un read")</span></a>
                                            @endif
                                        </td>
                                        <td> {{$one->created_at->diffForHumans()}} </td>
                                        <td>
                                            @if(permissionCheck('notifications.delete'))
                                                {!! deleteForm('notifications', $one) !!}
                                            @else
                                                -------
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="no-records-found" style="text-align: center;">
                                        <td colspan="5">@lang('No Data Founded')</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- start pagination -->
                        <div class="pagination-section">
                            <div class="container">
                                {!! $allNotifications->links() !!}
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
