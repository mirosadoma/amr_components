<ul class="nav nav-tabs" role="tablist">
    @foreach(app_languages() as $key=>$one)
        <li class="nav-item {{ $key == app()->getLocale() ? 'active' : '' }} tab-lang" data-id="tab-{{$key}}">
            <a class="nav-link {{$errors->first($key.'.*') ? 'text-danger' : ''}}"  data-toggle="tab" href="#" role="tab">
                <span class="hidden-sm-up"></span> <span class="hidden-xs-down">{{ $one['native'] }}</span>
            </a>
        </li>
    @endforeach
</ul>