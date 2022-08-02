<?php

namespace App\Components\Roles\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use Spatie\Permission\Models\Role;
// Requests
use App\Components\Roles\Requests\Dashboard\StoreRequest;
use App\Components\Roles\Requests\Dashboard\UpdateRequest;

class RolesController extends Controller {

    public function index() {
        if (!permissionCheck('roles.view')) {
            return abort(403);
        }
        $PageTitle = __('Roles');
        $Breadcrumb = [
            [
                'name'  =>  $PageTitle,
                'route' =>  'roles.index',
            ],
        ];
        if (permissionCheck('roles.create')) {
            $Button = [
                'title' => __('Add Role'),
                'route' =>  'roles.create',
                'icon'  => 'plus'
            ];
        }
        $lists = Role::query()->where('guard_name', 'admin');
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('name') && !empty(request('name'))) {
                $lists->where('name', 'LIKE', '%'.request('name').'%');
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
        }
        $lists = $lists->paginate();
        return view('Roles_Dashboard::index' , get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('roles.create')) {
            return abort(403);
        }
        return view('Roles_Dashboard::create');
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('roles.create')) {
            return abort(403);
        }
        $role = Role::updateOrCreate(['guard_name'=>'admin', 'name'=>$request->name]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('app.roles.index')->with('success', __("Data Saved Successfully"));
    }

    public function edit(Role $role) {
        if (!permissionCheck('roles.update')) {
            return abort(403);
        }
        $check_roles = \Auth::guard('admin')->user()->getPermissionsViaRoles()->pluck('name')->toArray();
        return view('Roles_Dashboard::edit', get_defined_vars());
    }

    public function update(UpdateRequest $request, Role $role) {
        if (!permissionCheck('roles.update')) {
            return abort(403);
        }
        $role->update(['guard_name'=>'admin', 'name'=>$request->name]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('app.roles.index')->with('success', __("Data Updated Successfully"));
    }

    public function destroy(Role $role) {
        if (!permissionCheck('roles.delete')) {
            return abort(403);
        }
        if (count($role->users) == 0) {
            $role->delete();
            return redirect()->route('app.roles.index')->with('success', __("Data Deleted Successfully"));
        } else {
            return redirect()->back()->with('error', __("This role cannot be deleted because it is associated with a user"));
        }
    }
}
