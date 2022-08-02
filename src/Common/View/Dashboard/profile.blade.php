@extends('DCommon::master')
@section('content')

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title">Profile<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse" class=""></a></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="{{ route('dashboard.DProfile.update') }}" enctype="multipart/form-data">
            <fieldset>
                <legend class="text-bold"><?php echo __('Profile') ?></legend>
                {!! from_input('name','Name','text',\Auth::user()->name) !!}
                {!! from_input('email','Email','email',\Auth::user()->email) !!}
                {!! from_input('password','Password','password') !!}
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        <?php echo __('Save') ?>
                        <i class="icon-arrow-left13 position-right"></i>
                    </button>
                </div>
                <div class="hidden">
                    @csrf
                </div>
            </fieldset>
        </form>
    </div>
</div>

@endsection
