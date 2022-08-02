@if($option['Model']::Reports)
    <div class="col-sm-6 col-md-3">
        @if ($option['url'] == '#')
            <a href="#!" target="_blank">
        @else
            <a href="{{ route('dashboard.'.$option['url']) }}" target="_blank">
        @endif
            <div class="panel panel-body panel-body-accent">
                <div class="media no-margin">
                    <div class="media-left media-middle">
                        <i class="{{ $option['icon'] }} icon-3x text-success-400"></i>
                    </div>
                    <div class="media-body text-right">
                        <h3 class="no-margin text-semibold">
                            {{ $option['Model']::count() }}
                        </h3>
                        <span class="text-uppercase text-size-mini text-muted">@lang($option['title'])</span>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endif