<?php

if (!function_exists('Inputs')) {
    function Inputs($type, $name, $placholder='', $class = 'form-control', $value = '', $required = false, $multiple = false)
    {
        $data = '';
        if ($required == true) {
            $required = 'required';
        }else {
            $required = '';
        }
        if ($type == 'file') {
            if ($multiple == true) {
                $multiple = 'multiple';
            }else {
                $multiple = '';
            }
            $data .= "<label class=\"col-lg-2 control-label text-semibold\">".__($placholder)."</label>";
            $data .= "<div class=\"col-lg-10\">";
            // $data .= "<div class=\"fileinput fileinput-new\" data-provides=\"fileinput\">";
            // $data .= "<div class=\"fileinput-preview thumbnail\" data-trigger=\"fileinput\" style=\"width: 330px; height: 150px;\">";
            // if($value && !is_string($value) && $value->count()){
            //     foreach($value as $item) {
            //         $item = url($item->image);
            //         $data .= "<img src=\"{$item}\">";
            //     }
            // }else{
            //     if ($value) {
            //         $value = url($value);
            //         $data .= "<img src=\"{$value}\">";
            //     }
            // }
            // $data .= "</div>";
            // $data .= "<div>";
            // $data .= "<span class=\"btn blue btn-outline btn-file\">";
            // $data .= "<span class=\"fileinput-new\"> ".__('Choose Image')." </span>";
            // $data .= "<span class=\"fileinput-exists\"> ".__('Change')." </span>";
            $data .= "<input type=\"file\" name=\"{$name}\" class=\"{$class}\" data-show-caption=\"true\" data-show-upload=\"false\" ".$multiple.' '.$required.">";
            // $data .= "</span>";
            // $data .= "<a href=\"javascript:;\" class=\"btn blue fileinput-exists\" data-dismiss=\"fileinput\"> ".__('Delete')." </a>";
            // $data .= "</div>";
            // $data .= "</div>";
            $data .= "</div>";
        }else {
            $data .= "<label class=\"control-label col-lg-2\">".__($placholder)."</label>";
            $data .= "<div class=\"col-lg-10\">";
            $data .= "<input type=\"{$type}\" name=\"{$name}\" placeholder=\"".__($placholder)."\" class=\"{$class}\" value=\"{$value}\" ".$required.">";
            // if($errors->has($name)){
            //     $data .= "<p class=\"text-danger\">{{ $errors->first(".$name.") }}</p>";
            // }
            $data .= "</div>";
        }
        return $data;
    }
}

if (!function_exists('Selects')) {
    function Selects($name, $title, $array=[], $class = 'form-control', $firstOption = 'Choose', $checkValues=[], $multiple = false)
    {
        $data = '';
        if (!empty($array)) {
            if ($multiple == true) {
                $multiple = 'multiple';
            }else {
                $multiple = '';
            }
            $data .= "<label class=\"control-label\">".__($title)."</label>";
            $data .= "<div class=\"input-icon right\">";
            $data .= "<select name=\"{$name}\" class=\"{$class}\" ".$multiple.">";
            $data .= "<option value=\"0\">".__($firstOption)."</option>";
            if ($array['array'] && $array['array']->count()) {
                foreach ($array['array']->toArray() as $item) {
                    if (!empty($checkValues)) {
                        if (isset($checkValues['thirdCondition'])) {
                            if ($checkValues['thirdCondition'] > 0 && $item[$checkValues['id']] == $checkValues['value']) {
                                $checkCondition = 'selected'; 
                            }else {
                                $checkCondition = '';
                            }
                        }else{
                            if($item[$checkValues['id']] == $checkValues['value']) {
                                $checkCondition = 'selected'; 
                            }else {
                                $checkCondition = '';
                            }
                        }
                    }else {
                        $checkCondition = '';
                    }
                    $data .= "<option value=\"{$item[$array['id']]}\" $checkCondition>{$item[$array['name']]}</option>";
                }
                $data .= '</select>';
                $data .= '</div>';
            }
        }
        return $data;
    }
}

if (!function_exists('SubmitButton')) {
    function SubmitButton($title)
    {
        return "<button type=\"submit\" class=\"btn btn-primary pull-right\" style=\" top: 8px; \">".__($title)."<i class=\"icon-floppy-disk position-right\"></i></button>";
    }
}

if (!function_exists('BackButton')) {
    function BackButton($title, $route)
    {
        return "<a href=\"{$route}\" class=\"btn btn-secondary pull-right\" style=\" top: 8px; \">".__($title)."</a>";
    }
}

if (!function_exists('TextArea')) {
    function TextArea($name, $title, $class = "form-control", $value, $editor = false, $id_name = '')
    {
        $data = '';
        $id = '';
        $data .= "<label class=\"control-label col-lg-2\">".__($title)."</label>";
        $data .= "<div class=\"input-icon right col-lg-10\">";
        if ($editor == true) {
            if (!empty($id_name)) {
                $id = $id_name;
            }else{
                $id = "editor";
            }
        }
        
        $data .= "<textarea name=\"{$name}\" id=\"{$id}\" class=\"{$class}\" required rows=\"3\" placeholder=\"".__($title)."\">{$value}</textarea>";
        $data .= "</div>";

        return $data;
    }
}