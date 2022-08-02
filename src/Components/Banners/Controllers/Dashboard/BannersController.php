<?php

namespace App\Components\Banners\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Components\Banners\Models\Banner;
// Requests
use App\Components\Banners\Requests\Dashboard\UpdateRequest;
use App\Components\Banners\Requests\Dashboard\StoreRequest;

class BannersController extends Controller {

    public function index() {
        if (!permissionCheck('banners.view')) {
            return abort(403);
        }
        $PageTitle = __('All Banners');
        $Breadcrumb = [
            [
                'name'  =>  $PageTitle,
                'route' =>  'banners.index',
            ],
        ];
        if (permissionCheck('banners.create')) {
            $Button = [
                'title' => __('Add Banner'),
                'route' =>  'banners.create',
                'icon'  => 'plus'
            ];
        }
        $search  = Banner::FORM_SEARCH();
        $lists = Banner::query();
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('is_active') && !is_null(request('is_active'))) {
                $lists->where('is_active', request('is_active'));
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
        }
        $lists = $lists->orderBy('id', "DESC")->paginate();
        return view('Banners_Dashboard::index',get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('banners.create')) {
            return abort(403);
        }
        $PageTitle = __('Add Banner');
        $ValidaionPath = 'App\Components\Banners\Requests\Dashboard\StoreRequest';
        $Breadcrumb = [
            [
                'name'      =>  __('All Banners'),
                'route'     =>  'banners.index',
            ],
            [
                'name'      =>  $PageTitle,
                'route'     =>  'banners.create',
            ],
        ];
        $Button = [
            'title'         => __('Back To Banners'),
            'route'         =>  'banners.index',
            'icon'          => 'arrow-left'
        ];
        $info  = null;
        $array = [
            'title'         => $PageTitle,
            'route'         => route('app.banners.store'),
            'submit'        =>'Save',
            'type'          =>'create',
            'back_route'    => route('app.banners.index')
        ];
        $data  = Banner::FORM_INPUTS();
        $data = array_merge($data,$array);
        return view('Banners_Dashboard::action',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('banners.create')) {
            return abort(403);
        }
        $data = $request->all();
        if (request()->has('image')) {
            $data['image']  = imageUpload($request->image, 'banners');
        }
        $data['is_active'] = 1;
        Banner::create($data);
        return redirect()->route('app.banners.index')->with('success', __('Data Saved Successfully'));
    }

    public function edit(Banner $banner) {
        if (!permissionCheck('banners.update')) {
            return abort(403);
        }
        $PageTitle = __('Edit City');
        $ValidaionPath = 'App\Components\Banners\Requests\Dashboard\UpdateRequest';
        $Breadcrumb = [
            [
                'name'      =>  __('All Banners'),
                'route'     =>  'banners.index',
            ],
            [
                'name'      =>  $PageTitle,
                'route'     =>  'banners.edit',
            ],
        ];
        $Button = [
            'title'         => __('Back To Banners'),
            'route'         =>  'banners.index',
            'icon'          => 'arrow-left'
        ];
        $info  = $banner;
        $array = [
            'title'         => $PageTitle,
            'route'         => route('app.banners.update',$banner->id),
            'method'        =>'PUT',
            'submit'        =>'Update',
            'type'          =>'update',
            'back_route'    => route('app.banners.index')
        ];
        $data  = Banner::FORM_INPUTS();
        $data = array_merge($data,$array);
        return view('Banners_Dashboard::action',get_defined_vars());
    }

    public function update(UpdateRequest $request, Banner $banner) {
        if (!permissionCheck('banners.update')) {
            return abort(403);
        }
        $data = $request->all();
        if (request()->has('image')) {
            $data['image']      = imageUpload($request->image, 'banners', [], false, true, $banner->image);
        }else{
            unset($data['image']);
        }
        $banner->update($data);
        return redirect()->route('app.banners.index')->with('success', __('Data Updated Successfully'));
    }

    public function destroy(Banner $banner) {
        if (!permissionCheck('banners.delete')) {
            return abort(403);
        }
        $banner->delete();
        return redirect()->route('app.banners.index')->with('success', __('Data Deleted Successfully'));
    }

    public function is_active($banner)
    {
        $banner = Banner::find($banner);
        if ($banner->is_active == 0) {
            $banner->update(['is_active' => 1]);
        }else{
            $banner->update(['is_active' => 0]);
        }
        return redirect()->back()->with('success', __('Status Updated Successfully'));
    }

    public function remove_image($banner) {
        $banner = Banner::find($banner);
        DeleteImage($banner->image);
        $banner->update([
            'image' => null
        ]);
        return response()->json([
            'message' => __('Image Deleted Successfully'),
        ]);
    }
}
