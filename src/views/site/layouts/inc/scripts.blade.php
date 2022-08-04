<script src="{{asset('assets')}}/site/js/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="{{asset('assets')}}/site/js/bootstrap.min.js"></script>
<script src="{{asset('assets')}}/site/js/owl.carousel.min.js"></script>
<script src="{{asset('assets')}}/site/js/all.min.js"></script>
<script src="{{asset('assets')}}/site/js/wow.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{asset('assets')}}/site/js/main.js"></script>
@include('site.layouts.inc._firebase')
@stack('scripts')
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