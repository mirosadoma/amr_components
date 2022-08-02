<?php

namespace App\Components\Admins\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\Admin;
use Spatie\Permission\Models\Role;
// Requests
use App\Components\Admins\Requests\Dashboard\StoreRequest;
use App\Components\Admins\Requests\Dashboard\UpdateRequest;

class AdminsController extends Controller {

    public function index() {
        if (!permissionCheck('admins.view')) {
            return abort(403);
        }
        $PageTitle = __('All Admins');
        $Breadcrumb = [
            [
                'name'  =>  $PageTitle,
                'route' =>  'admins.index',
            ],
        ];
        if (permissionCheck('admins.create')) {
            $Button = [
                'title' => __('Add Admin'),
                'route' =>  'admins.create',
                'icon'  => 'plus'
            ];
        }
        $search  = Admin::FORM_SEARCH();
        $lists = Admin::query()->where('type', 'admin')->where('id', '<>', 1);
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('name') && !empty(request('name'))) {
                $lists->where('name', 'LIKE', '%'.request('name').'%');
            }
            if (request()->has('email') && !empty(request('email'))) {
                $lists->where('email', 'LIKE', '%'.request('email').'%');
            }
            if (request()->has('phone') && !empty(request('phone'))) {
                $lists->where('phone', 'LIKE', '%'.request('phone').'%');
            }
            if (request()->has('is_active') && !is_null(request('is_active'))) {
                $lists->where('is_active', request('is_active'));
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
            $lists = $lists->orderBy('id', "DESC")->paginate();
        }elseif(request()->has('type')) {
            if (request('type') == "active") {
                $lists = $lists->where('is_active', 1)->orderBy('id', "DESC")->paginate()->appends(['type' => 'active']);
            }else if(request('type') == "unactive"){
                $lists = $lists->where('is_active', 0)->orderBy('id', "DESC")->paginate()->appends(['type' => 'unactive']);
            }else if(request('type') == "deleted"){
                $lists = $lists->onlyTrashed()->orderBy('id', "DESC")->paginate()->appends(['type' => 'deleted']);
            }else{
                $lists = $lists->orderBy('id', "DESC")->paginate();
            }
        }else{
            $lists = $lists->orderBy('id', "DESC")->paginate();
        }
        return view('Admins_Dashboard::index',get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('admins.create')) {
            return abort(403);
        }
        $PageTitle = __('Add Admin');
        $ValidaionPath = 'App\Components\Admins\Requests\Dashboard\StoreRequest';
        $Breadcrumb = [
            [
                'name'      =>  __('All Admins'),
                'route'     =>  'admins.index',
            ],
            [
                'name'      =>  $PageTitle,
                'route'     =>  'admins.create',
            ],
        ];
        $Button = [
            'title'         => __('Back To Admins'),
            'route'         =>  'admins.index',
            'icon'          => 'arrow-left'
        ];
        $info  = null;
        $array = [
            'title'         => $PageTitle,
            'route'         => route('app.admins.store'),
            'submit'        =>'Save',
            'type'          => 'create',
            'back_route'    => route('app.admins.index')
        ];
        $data  = Admin::FORM_INPUTS();
        $data = array_merge($data,$array);
        $roles = Role::where('guard_name', 'admin')->where('id','<>', 1)->get();
        return view('Admins_Dashboard::action',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('admins.create')) {
            return abort(403);
        }
        $data = $request->all();
        if (request()->has('image')) {
            $data['image']  = imageUpload($request->image, 'admins');
        }
        $data['password']   = bcrypt($request->password);
        $data['type']       = 'admin';
        $data['is_active']  = 1;
        $admin              = Admin::create($data);
        $admin->syncRoles($request->role_name);
        return redirect()->route('app.admins.index')->with('success', __('Data Saved Successfully'));
    }

    public function edit($admin) {
        if (\Auth::guard('admin')->user()->id != $admin) {
            if (!permissionCheck('admins.update')) {
                return abort(403);
            }
        }
        $PageTitle = __('Edit Admin');
        $ValidaionPath = 'App\Components\Admins\Requests\Dashboard\UpdateRequest';
        $Breadcrumb = [
            [
                'name'      => __('All Admins'),
                'route'     => 'admins.index',
            ],
            [
                'name'      => $PageTitle,
                'route'     => 'admins.edit',
            ],
        ];
        $Button = [
            'title'         => __('Back To Admins'),
            'route'         => 'admins.index',
            'icon'          => 'arrow-left'
        ];
        $admin = Admin::where('type', 'admin')->withTrashed()->find($admin);
        $info  = $admin;
        $array = [
            'title'         => $PageTitle,
            'route'         => route('app.admins.update',$admin->id),
            'method'        => 'PUT',
            'submit'        => 'Update',
            'type'          => 'update',
            'back_route'    => route('app.admins.index')
        ];
        $data  = Admin::FORM_INPUTS();
        $data = array_merge($data,$array);
        if (\Auth::guard('admin')->user()->id == 1) {
            $roles = Role::where('guard_name', 'admin')->get();
        }else{
            if ($admin->id == 1) {
                $roles = Role::where('guard_name', 'admin')->get();
            }else{
                $roles = Role::where('guard_name', 'admin')->where('id','<>', 1)->get();
            }
        }
        return view('Admins_Dashboard::action',get_defined_vars());
    }

    public function update(UpdateRequest $request, $admin) {
        if (\Auth::guard('admin')->user()->id != $admin) {
            if (!permissionCheck('admins.update')) {
                return abort(403);
            }
        }
        $admin = Admin::where('type', 'admin')->withTrashed()->find($admin);
        $data = $request->all();
        if (request()->has('image')) {
            $data['image']      = imageUpload($request->image, 'admins', [], false, true, $admin->image);
        }else{
            unset($data['image']);
        }
        if ($request->has("password") && !is_null($request->password)) {
            $data['password']   = bcrypt($request->password);
        }else{
            unset($data['password']);
        }
        $data['type']           = 'admin';
        $admin->update($data);
        $admin->syncRoles($request->role_name);
        return redirect()->route('app.admins.index')->with('success', __('Data Updated Successfully'));
    }

    public function destroy($admin) {
        if (!permissionCheck('admins.delete')) {
            return abort(403);
        }
        $admin = Admin::where('type', 'admin')->withTrashed()->find($admin);
        if ($admin->id == 1) {
            return redirect()->back()->with('error', __("You Can't Delete This Admin"));
        }
        $admin->delete();
        return redirect()->route('app.admins.index')->with('success', __('Data Deleted Successfully'));
    }

    public function deleteForever($admin) {
        if (!permissionCheck('admins.delete')) {
            return abort(403);
        }
        $admin = Admin::where('type', 'admin')->withTrashed()->find($admin);
        if ($admin->id == 1) {
            return redirect()->back()->with('error', __("You Can't Delete This Admin"));
        }
        DeleteImage($admin->image);
        $admin->forceDelete();
        return redirect()->back()->with('success', __('Data Deleted Forever Successfully'));
    }

    public function restore($admin) {
        if (!permissionCheck('admins.delete')) {
            return abort(403);
        }
        $admin = Admin::where('type', 'admin')->withTrashed()->find($admin);
        $admin->restore();
        return redirect()->back()->with('success', __('Data Restore Successfully'));
    }

    public function is_active($admin)
    {
        $admin = Admin::where('type', 'admin')->withTrashed()->find($admin);
        if ($admin->is_active == 0) {
            $admin->update(['is_active' => 1]);
        }else{
            $admin->update(['is_active' => 0]);
        }
        return redirect()->back()->with('success', __('Status Updated Successfully'));
    }

    public function remove_image($admin) {
        $admin = Admin::where('type', 'admin')->withTrashed()->find($admin);
        DeleteImage($admin->image);
        $admin->update([
            'image' => null
        ]);
        return response()->json([
            'message' => __('Image Deleted Successfully'),
        ]);
    }

    public function update_dark_position() {
        $admin = Admin::where('type', 'admin')->withTrashed()->find(\Auth::guard('admin')->user()->id);
        if($admin->is_dark == 1){
            $admin->update(['is_dark' =>  0]);
        }else{
            $admin->update(['is_dark' =>  1]);
        }
        return 'true';
    }
}
