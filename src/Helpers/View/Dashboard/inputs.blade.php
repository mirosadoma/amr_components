@foreach ($data as $item)
    <?php
        $editor = isset($item['editor']) && $item['editor'];
        $autocomplete = (isset($item['autocomplete'])) ?$item['autocomplete']: "off";
        if(isset($info)) {
            if(is_array($info)) {
                if(!empty($info)) {
                    $value = (array_key_exists($item['name'],$info)) ? $info[$item['name']]['retrun']->{$info[$item['name']]['search']} : '';
                } else {
                    $value = '';
                }
            } else {
                $value = $info->{$item['name']};
            }
        } else {
            $value  = (isset($info)) ? $info->{$item['name']}: '';
        }
    ?>
    @if ($item['type'] == 'select')
        <?php
            $multiple = isset($item['multiple']) && $item['multiple'] == true;
        ?>
        {!! SELECTINPUT($item['name'],$item['label'],$item['options'],$value,$errors,$multiple) !!}
    @else
        {!! inputForm($item['name'],$item['label'],$item['type'],$value,$errors,$editor,$autocomplete) !!}
    @endif
@endforeach
