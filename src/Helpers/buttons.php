<?php

if (!function_exists('deleteForm')) {
    function deleteForm($route, $row)
    {
        $confirmMsg = __('Are you sure?');
        $unique = rand(1,1000);
        if (is_array($row)) {
            $pp = route("app.{$route}.destroy", $row);
        } else {
            $pp = route("app.{$route}.destroy", $row->id);
        }
        $form = '<form action="' . $pp . '" method="post" class="d-inline-block" id="'.$unique.'">
                <input name="_method" type="hidden" value="delete">
                <input type="hidden" name="_token" id="csrf-token" value="' . \Session::token() . '" />';
        $form .= '<button type="submit" class="btn btn-icon btn-outline-danger waves-effect delete-record" title="'.__('Delete').'">
            <i data-feather="trash-2"></i></button>';
        $form .= '</form>';

        return $form;
    }
}
if (!function_exists('destroyForm')) {
    function destroyForm($route, $row)
    {
        if (is_array($row)) {
            $pp = route("app.{$route}.deleteForever", $row);
        } else {
            $pp = route("app.{$route}.deleteForever", $row->id);
        }
        $form = '<a href="'.$pp.'" class="btn btn-icon btn-outline-danger waves-effect delete-record" title="'.__('Delete Forever').'">
                <i data-feather="trash"></i></a>';
        return $form;
    }
}

if (!function_exists('restoreForm')) {
    function restoreForm($route, $row)
    {
        $pp = route("app.{$route}.restore", $row->id);
        $form = '<a class="btn btn-icon btn-outline-info waves-effect mr-1" href="' . $pp . '" title="'.__('Restore').'">
                <i data-feather="rotate-cw"></i></a>';
        return $form;
    }
}

if (!function_exists('showForm')) {
    function showForm($route, $row)
    {
        $pp = route("app.{$route}.show", $row->id);
        $form = '<a class="btn btn-icon btn-outline-primary waves-effect mr-1" href="' . $pp . '" title="'.__('Show').'">
                <i data-feather="eye"></i></a>';
        return $form;
    }
}

if (!function_exists('editForm')) {
    function editForm($route, $row)
    {
        $pp = route("app.{$route}.edit", $row->id);
        $form = '<a class="btn btn-icon btn-outline-success waves-effect mr-1" href="' . $pp . '" title="'.__('Edit').'">
                <i data-feather="edit"></i></a>';
        return $form;
    }
}
