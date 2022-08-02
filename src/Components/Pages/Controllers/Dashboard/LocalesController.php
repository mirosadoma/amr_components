<?php

namespace App\Components\Pages\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocalesController extends Controller {

    public function index() {
        if (!permissionCheck('pages.locales')) {
            return abort(403);
        }
        $Breadcrumb = [
            [
                'name'  =>  __('Pages'),
                'route' =>  'pages.index',
            ],
            [
                'name'  =>  __('Locales'),
                'route' =>  'pages.locales.index',
            ],
        ];
        $Button = [];
        return view('Pages_Dashboard::locales', get_defined_vars());
    }

    public function store(Request $request) {
        if (!permissionCheck('pages.locales')) {
            return abort(403);
        }
        $data = [];
        foreach (request('locale') as $value) {
            if (count($value) > 2) {
                if (isset($value['Arabic']) && isset($value['English'])) {
                    $data[$value['English']] = $value['Arabic'];
                }elseif (isset($value['Arabic']) && !isset($value['English'])) {
                    $data[$value['index']] = $value['Arabic'];
                }elseif (isset($value['English']) && !isset($value['Arabic'])) {
                    $data[$value['English']] = $value['title'];
                }else{
                    $data[$value['index']] = $value['title'];
                }
            }else{
                $data[$value['index']] = $value['title'];
            }
        }
        file_put_contents(app_path() . '/Components/Pages/Views/Lang/ar.json', json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return 1;
    }

    public function show($locale) {
        if (!permissionCheck('pages.locales')) {
            return abort(403);
        }
        $locals = json_decode(trim(file_get_contents(app_path() . '/Components/Pages/Views/Lang/ar.json')));
        $locle = [];
        foreach ($locals as $k => $v) {
            $locle[] = [
                'index' => $k,
                'title' => $v
            ];
        }
        return $locle;
    }
}
