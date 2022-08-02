<!-- BEGIN: Vendor JS-->
{!! assetAdmin('app-assets/vendors/js/vendors.min.js','js') !!}
{!! assetAdmin('app-assets/fileinput/js/piexif.min.js','js') !!}
@if (\App::getLocale() == "en")
    {!! assetAdmin('app-assets/fileinput/js/fileinput.en.js','js') !!}
@else
    {!! assetAdmin('app-assets/fileinput/js/fileinput.ar.js','js') !!}
@endif
<!-- END Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
{!! assetAdmin('app-assets/vendors/js/editors/quill/katex.min.js','js') !!}
{!! assetAdmin('app-assets/vendors/js/editors/quill/highlight.min.js','js') !!}
{!! assetAdmin('app-assets/vendors/js/editors/quill/quill.min.js','js') !!}
{!! assetAdmin('app-assets/vendors/js/extensions/toastr.min.js','js') !!}
{!! assetAdmin('app-assets/vendors/js/forms/select/select2.full.min.js','js') !!}
{!! assetAdmin('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js','js') !!}
{!! assetAdmin('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js','js') !!}
{!! assetAdmin('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js','js') !!}
{!! assetAdmin('app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js','js') !!}
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
{!! assetAdmin('app-assets/js/core/app-menu.js','js') !!}
{!! assetAdmin('app-assets/js/core/app.js','js') !!}
<!-- END: Theme JS-->

{!! assetAdmin('app-assets/js/scripts/forms/form-select2.js','js') !!}

<!-- BEGIN: Page JS-->
{!! assetAdmin('app-assets/js/scripts/pages/app-email.js','js') !!}
<!-- END: Page JS-->

<!-- BEGIN: tag input-->
{!! assetAdmin('app-assets/InputTags/InputTags.js','js') !!}
<!-- END: tag input-->

<!-- BEGIN: loader-->
{!! assetAdmin('app-assets/loader/loader.js','js') !!}
<!-- END: loader-->

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
    $('.tab-lang').on('click', function () {
        var id = $(this).attr('data-id');
        $(this).parent().find('.nav-item').removeClass('active');
        $(this).addClass('active');
        $('.tab-pane').removeClass('active');
        $('#'+id).addClass('active');
    })
</script>
<script>
    $(document).ready(function () {
        $('.navigation-main>li').each(function () {
            var _this = this;
            if (!$(_this).hasClass('has-sub')) {
                $(_this).removeClass('active nav-item');
                var link = $(_this).find('a').attr('href');
                if (link == window.location.href) {
                    $(_this).addClass('active nav-item');
                }
            }else{
                $(_this).find('ul').find('li').find('a').each(function () {
                    $(this).parent().removeClass('active nav-item');
                    var link = $(this).attr('href');
                    if (link == window.location.href) {
                        $(this).parent().addClass('active nav-item');
                    }
                });
            }
        });
    });
    $('.navigation-header input').keyup(function() {
        var value = $(this).val().toLowerCase();
        $('.navigation li').not('.navigation-header').each(function(i, element) {
            var list = $(element);
            var text = list.text().toLowerCase();
            if (text.trim() === "") {
                list.show();
            }
            if (text.search(value) === -1) {
                list.hide();
            }else {
                list.show();
            }
        });
    });
</script>
<script>
    $(function () {
        $('.moon_ajax').click(function () {
            var url = _url_ + 'app/admins/update_dark_position';
            $.post(url, {_token:_token_}, function(data) {
                console.log('done');
            });
        });
        $(".select-search").select2({
            placeholder: "{{__('Choose')}}",
            allowClear: true
        });
        $(".translate").on('click', function(e){
            e.preventDefault();
            $('#translate').modal('toggle');
        });
        $(".modal .btn-close, .modal .close").on('click', function(e){
            e.preventDefault();
            $(this).parents('#translate').modal('hide');
        });
    });
</script>
<script>
    $(".select-search").select2();
    $(".select-multiple-tags").select2();
    function resetForm() {
        $(".select-search > option").removeAttr("selected");
        $(".select-search").val(null).trigger('change');
        $(":input").not(':button, :submit, :reset, :hidden, :checkbox, :radio').val("");
        $(":input").not(':button, :submit, :reset, :hidden, :checkbox, :radio').trigger("reset");
    }
</script>
<script>
    $(window).on('load', function() {
        $('.menu-collapsed .navigation-main').find('.open').removeClass('open');
    });
</script>
<script>
    $(function () {
        $('.delete-record').click(function (e) {
            if (confirm('{{ __("Are You Sure ?") }}')) {
                $(this).parent().submit();
            } else {
                e.preventDefault();
            }
        });
    });
</script>
<script>
    function AlertMe(type = 'success',message) {
        if(message != undefined) {
            toastr[type]("",message, { timeOut: 5000,closeButton:true,positionClass: "toast-top-right",});
        }
    }
</script>
@if(session()->has('success'))
    <script>
       AlertMe('success',"{{ session()->get("success") }}");
    </script>
@endif
@if(session()->has('error'))
    <script>
       AlertMe('error',"{{ session()->get("error") }}");
    </script>
@endif
@stack('scripts')
{{-- Main Search --}}
{{-- <script>
    $('.search-input input').on('keyup', function (e) {
        var _this = $(this);
        _this.closest('.search-list').addClass('show');
        if (e.keyCode !== 38 && e.keyCode !== 40 && e.keyCode !== 13) {
            if (e.keyCode == 27) {
                $('.app-content').removeClass('show-overlay');
                $('.bookmark-wrapper .bookmark-input').find('input').val('');
                $('.bookmark-wrapper .bookmark-input').find('input').blur();
                $('.search-input input').val('');
                $('.search-input input').blur();
                $('.search-input').removeClass('open');
                if ($('.search-input').hasClass('show')) {
                _this.removeClass('show');
                $('.search-input').removeClass('show');
                }
            }
            const result = fuse.search(_this.val())
            console.log(result);
            var url = _url_ + 'app/settings/main_search';
            $.post(url, {_token:_token_,value:_this.val()}, function(data) {
                console.log('done');
            });
        }
    });
</script> --}}
