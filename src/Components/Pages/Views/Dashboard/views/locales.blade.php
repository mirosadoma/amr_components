@extends('admin.layouts.master')
@section('head_title'){{__('Locales')}}@endsection
@push('styles')
    <style>
        .activeme {
            background: #3f51b51f;
            border-radius: 7px;
            padding: 10px;
        }
        .top_header {
            position: sticky;
            top: 0;
            background: #fff;
            overflow: hidden;
            width: 100%;
            z-index: 999;
            border-bottom: 1px solid #e3e3e3;
        }
    </style>
@endpush
@section('content')
    @include('admin.layouts.inc.breadcrumb', ['array' => $Breadcrumb,'button' => $Button??[]])
    <div class="content-body">
        <!-- Advanced Search -->
        <section id="advanced-search-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card" id="page_layout">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">@lang('Advanced Search')</h4>
                            <div class="card-title">
                                <button type="submit" class="btn btn-primary btn-round waves-effect waves-float waves-light" title="{{__("Save")}}" @click.prevent="Save()">
                                    @lang("Save")
                                    <i data-feather="database"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body mt-2">
                            <input type="text" placeholder="@lang('Search')" class="form-control" v-model="searchValue" style="width: 25%;"/>
                        </div>
                        <hr>
                        <!--Search Form -->
                        <div class="card-body">
                            <div class="col-md-12" style="margin-bottom: 9px;">
                                <div class="local_append content-group">
                                    <div class="form-group ">
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <input type="text" class="form-control" v-model="index" placeholder="{{__('English')}}">
                                                </div>
                                                <div class="col-lg-5">
                                                    <input type="text" class="form-control" v-model="title" placeholder="{{__('Arabic')}}">
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="btn btn-primary" @click.prevent="AddNewRow()"> @lang('Add') </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-0" />
                        <div class="card-body table-responsive">
                            {{-- start here --}}
                            <div class="col-md-12" v-for="(value, index) of filteredTitle">
                                <div class="local_append content-group" v-bind:class="{ 'activeme':value.classAtive }">
                                    <div class="form-group ">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <input type="text" @change="addEvent" :id="index" placeholder="English" class="form-control" :value="value.index">
                                                </div>
                                                <div class="col-lg-5">
                                                    <input type="text" @change="addEvent" :id="index" placeholder="Arabic" class="form-control" :value="value.title">
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="btn btn-danger delete" @click.prevent="deleteRow(index)"> @lang('Delete') </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            {{-- end here --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/ Advanced Search -->
    </div>
@endsection
@push('scripts')
    {!! vue_srcs() !!}
    <script>
        var locale_index = "{{ route('app.pages.locales.store') }}";
        var locale_store = "{{ route('app.pages.locales.show',1) }}";
        new Vue({
            el: '#page_layout',
            data: {
                index: '',
                title: '',
                searchValue: '',
                localeList: [],
            },
            methods: {
                addEvent: function({type,target}) {
                    _this = this;
                    _this.localeList[target.id][target.placeholder] = target.value;
                },
                AddNewRow: function () {
                    if (this.index.trim() == "" || this.title.trim() == "") {
                        alert("{{__('Please Enter All Data')}}");
                    } else {
                        var check_index = this.localeList.filter((function (value) {
                            return value.index.toLowerCase().includes(this.index.toLowerCase());
                        }).bind(this));
                        this.localeList.unshift({'index': this.index, 'title': this.title, 'classAtive': true});
                        this.index = '';
                        this.title = '';
                    }
                },
                deleteRow: function (index) {
                    if (confirm("{{__('Are You Sure To Delete')}}")) {
                        this.localeList.splice(index, 1);
                    }
                },
                Save: function () {
                    if (confirm("{{__('Are You Sure To Save')}}")) {
                        _this = this;
                        axios.post(locale_index, {
                            locale: _this.localeList,
                            _token: _token_
                        }).then(function (response) {
                            if (response.data == true) {
                                if (confirm("{{__('Data Saved Successfully')}}")) {
                                    location.reload();
                                }
                            }
                        });
                    }
                }
            },
            created: function () {
                _this = this;
                axios.get(locale_store)
                    .then(function (response) {
                        _this.localeList = response.data;
                    });
            },
            watch: {
                index: function (index) {
                    this.index = index;
                },
                title: function (title) {
                    this.title = title;
                },
                searchValue: function (value) {
                    this.searchValue = value;
                }
            },
            computed: {
                filteredTitle: function () {
                    _this = this;
                    if (_this.searchValue === "") {
                        return _this.localeList;
                    } else {
                        return _this.localeList.filter((function (value) {
                            return value.title.toLowerCase().includes(this.searchValue.toLowerCase()) || value.index.toLowerCase().includes(this.searchValue.toLowerCase());
                        }).bind(this));
                    }
                }
            }
        });
    </script>
@endpush
