<?php

namespace App\Components\Settings\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// Models
use App\Components\Settings\Models\SiteConfig;
use App\Components\Settings\Models\SiteSocial;
use App\Components\Settings\Models\SiteMaintenance;
// Requests
use App\Components\Settings\Requests\Dashboard\UpdateRequest;

class SettingsController extends Controller {

    public function config() {
        if (!permissionCheck('settings.config')) {
            return abort(403);
        }
        $setting = SiteConfig::first();
        return view('Settings_Dashboard::config',get_defined_vars());
    }
    public function social() {
        if (!permissionCheck('settings.social')) {
            return abort(403);
        }
        $contacts = SiteSocial::all();
        return view('Settings_Dashboard::social',get_defined_vars());
    }
    public function maintenance() {
        if (!permissionCheck('settings.maintenance')) {
            return abort(403);
        }
        $setting = SiteMaintenance::first();
        return view('Settings_Dashboard::maintenance',get_defined_vars());
    }

    public function update(UpdateRequest $request, $type) {
        if (!permissionCheck('settings.update')) {
            return abort(403);
        }
        $data = $request->all();
        if($type == 'config'){
            Validator::make($request->all(),[
                'ar.title'              => 'required|string|between:2,200',
                'en.title'              => 'required|string|between:2,200',
                'ar.keywords'           => 'required',
                'en.keywords'           => 'required',
                'ar.description'        => 'required|string|between:2,2000',
                'en.description'        => 'required|string|between:2,2000',
                'address'               => 'required|string|between:2,1000',
                'email'                 => 'required|email:filter|between:2,200',
                'phone'                 => 'required|digits:9|regex:/^(5)?([0-9]){2}([0-9]){6}$/',
                'appstore'              => 'required|between:2,200',
                'googleplay'            => 'required|between:2,200',
                'logo'                  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ])->validate();
            $setting = SiteConfig::first();
            if (request()->has('logo')) {
                $data['logo']      = fileUpload($request->logo, 'settings', true, $setting->logo);
            }else{
                unset($data['logo']);
            }
            if (request()->has('footer_logo')) {
                $data['footer_logo']      = fileUpload($request->footer_logo, 'settings', true, $setting->footer_logo);
            }else{
                unset($data['footer_logo']);
            }
            $setting->update($data);
            return redirect()->back()->with('success', __('Data Updated Successfully'));
        }else if($type == 'social'){
            $social = SiteSocial::truncate();
            $i = 0;
            foreach ($data['type'] as $tp) {
                if ($data['value'][$i] && $data['value'][$i] != '' && $data['value'][$i] != ' ') {
                    $social->create([
                        'type' => $data['type'][$i],
                        'class' => $data['class'][$i],
                        'value' => $data['value'][$i]
                    ]);
                }
                $i++;
            }
            return redirect()->back()->with('success', __('Data Updated Successfully'));
        }else if($type == 'maintenance'){
            $setting = SiteMaintenance::first();
            $setting->update($data);
            return redirect()->back()->with('success', __('Data Updated Successfully'));
        }
    }

    public function remove_logo($setting) {
        $setting = SiteConfig::find($setting);
        DeleteFile($setting->logo);
        $setting->update([
            'logo' => null
        ]);
        return response()->json([
            'message' => __('Logo Deleted Successfully'),
        ]);
    }

    public function remove_footer_logo($setting) {
        $setting = SiteConfig::find($setting);
        DeleteFile($setting->footer_logo);
        $setting->update([
            'footer_logo' => null
        ]);
        return response()->json([
            'message' => __('Footer Logo Deleted Successfully'),
        ]);
    }

    // public function main_search() {
    //     dd("ss");
    //     $data = [];
    //     return $data;
    // }
}
