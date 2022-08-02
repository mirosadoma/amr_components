<?php

namespace App\Components\Locales\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocalesController extends Controller {

    public function index() {
        if (!permissionCheck('locales.view')) {
            return abort(403);
        }
        $PageTitle = __('All Locales');
        $Breadcrumb = [
            [
                'name'  =>  __('Locales'),
                'route' =>  'locales.index',
            ],
        ];
        return view('Locales_Dashboard::index', get_defined_vars());
    }
    public function store(Request $request) {
        if (!permissionCheck('locales.create')) {
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
        file_put_contents(resource_path('lang/ar.json'), json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return 1;
    }

    public function show($locale) {
        if (!permissionCheck('locales.view')) {
            return abort(403);
        }
        $locals = json_decode(trim(file_get_contents(resource_path('lang/ar.json'))));
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
