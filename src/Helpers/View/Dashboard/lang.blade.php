<div class="card-body table-responsive">
    <fieldset>
        @foreach(app_languages() as $key=>$one)
            <div class="tab-pane {{ $key == app()->getLocale() ? 'active' : '' }}" id="tab-{{$key}}" role="tabpanel">
                <div class="form-body">
                    @if(isset($data['inputs']))
                        @foreach ($data['inputs'] as $item)
                            <?php
                                $name = $key."[".$item['name']."]";
                                $editor = (isset($item['editor'])) ? true: false;
                                if(isset($info)) {
                                    if(is_array($info)) {
                                        if(!empty($info)) {
                                            $value = (array_key_exists($item['name'],$info)) ? $info[$item['name']]['retrun']->translate($key)->{$info[$item['name']]['search']} : '';
                                        } else {
                                            $value = '';
                                        }
                                    } else {
                                        $value = $info->translate($key)->{$item['name']};
                                    }
                                } else {
                                    $value = old($key.".".$item['name']);
                                }
                            ?>
                            {!! inputForm($name,$item['label'],$item['type'],$value,$errors,$editor,'off','editor-'.$key) !!}
                        @endforeach
                    @endif
                </div>
            </div>
        @endforeach
    </fieldset>
</div>