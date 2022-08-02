@if(isset($error))
	<script>swal({html : "{{ $error }}", type : "error" , confirmButtonText : "{{ __('OK') }}"});</script>
@endif
@if(isset($true))
	<script>swal({html:"{{ $true }}", type :"success" , confirmButtonText : "{{ __('OK') }}"});</script>
@endif
@if(session()->has('message') || Session::has('message'))
	<script>swal({html:"{{ session('message') }}", type:"success" , confirmButtonText : "{{ __('OK') }}"});</script>
@endif

@if(session()->has('status') || Session::has('status'))
	<script>swal({html:"{{ session('status') }}", type:"success" , confirmButtonText : "{{ __('OK') }}"});</script>
@endif
@if(session()->has('success') || Session::has('success'))
	<script>swal({text:"{{ session('success') }}", type:"success"  , confirmButtonText : "{{ __('OK') }}"});</script>
@endif
@if(session()->has('error') || Session::has('error'))
	<script>swal({html:"{{ (string) is_array(session('error')) ? session('error')[0] : session('error') }}", type:"error" , confirmButtonText : "{{ __('OK') }}"});</script>
@endif
@if(session()->has('true') || Session::has('true'))
	<script>swal({html:"{{ session('true') }}",type:"success" , confirmButtonText : "{{ __('OK') }}"});</script>
@endif
@if(session()->has('warning') || Session::has('warning'))
	<script>swal({html:"{{ session('warning') }}",type:"warning" , confirmButtonText : "{{ __('OK') }}"});</script>
@endif
@if(!empty($errors->all()))
	<script>
	swal({
		html:"@foreach($errors->all() as $error)<li>{{$error}}</li>@endforeach",
		type:"error"
	});
	</script>
@endif