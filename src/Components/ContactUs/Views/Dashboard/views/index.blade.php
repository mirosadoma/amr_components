@extends('admin.layouts.master')
@section('head_title'){{__('All ContactUs')}}@endsection
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
                                    <th>@lang('Name')</th>
                                    <th {!! \table_width_head(6) !!}>@lang('Email')</th>
                                    <th {!! \table_width_head(3) !!}>@lang('Phone')</th>
                                    <th {!! \table_width_head(3) !!}>@lang("Replay")</th>
                                    <th {!! \table_width_head(6) !!}>@lang('Created At')</th>
                                    <th {!! \table_width_head(5) !!}>@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lists as $item)
                                    <tr>
                                        <td>
                                            <div class="success"></div>
                                            <a href="javascript:;"> {{$item->id}} </a>
                                        </td>
                                        <td> {{$item->name??'---------'}} </td>
                                        <td> {{$item->email??'---------'}} </td>
                                        <td> {{$item->phone??'---------'}} </td>
                                        <td>
                                            @if (!empty($item->reply) && !is_null($item->reply))
                                                <span class="label label-success" title="{{__('Answered')}}"><i data-feather="check" stroke-width="7" style="color: #00b800;"></i><span>
                                            @else
                                                <span class="label label-danger" title="{{__('No Response')}}"><i data-feather="x" stroke-width="7" style="color: red;"></i><span>
                                            @endif
                                        </td>
                                        <td> {{$item->created_at->diffForHumans()}} </td>
                                        <td>
                                            @if(permissionCheck('contact_us.view'))
                                                {!! showForm('contactus', $item) !!}
                                            @endif
                                            @if(permissionCheck('contact_us.delete'))
                                                {!! deleteForm('contactus', $item) !!}
                                            @endif
                                            @if(!permissionCheck('contact_us.update') && !permissionCheck('contact_us.delete')) ------- @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="no-records-found" style="text-align: center;">
                                        <td colspan="8">@lang('No Data Founded')</td>
                                    </tr>
                                @endforelse
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
