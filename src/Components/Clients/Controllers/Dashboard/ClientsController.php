<?php

namespace App\Components\Clients\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Models\User;
use App\Components\Cities\Models\City;
use App\Components\Countries\Models\Country;
// Requests
use App\Components\Clients\Requests\Dashboard\StoreRequest;
use App\Components\Clients\Requests\Dashboard\UpdateRequest;

class ClientsController extends Controller {

    public function index() {
        if (!permissionCheck('clients.view')) {
            return abort(403);
        }
        $PageTitle = __('All Clients');
        $Breadcrumb = [
            [
                'name'  =>  $PageTitle,
                'route' =>  'clients.index',
            ],
        ];
        if (permissionCheck('clients.create')) {
            $Button = [
                'title' => __('Add Client'),
                'route' =>  'clients.create',
                'icon'  => 'plus'
            ];
        }
        $search  = User::FORM_SEARCH();
        $lists = User::query()->where('type', 'client');
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
        return view('Clients_Dashboard::index',get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('clients.create')) {
            return abort(403);
        }
        $PageTitle = __('Add Client');
        $ValidaionPath = 'App\Components\Clients\Requests\Dashboard\StoreRequest';
        $Breadcrumb = [
            [
                'name'      =>  __('All Clients'),
                'route'     =>  'clients.index',
            ],
            [
                'name'      =>  $PageTitle,
                'route'     =>  'clients.create',
            ],
        ];
        $Button = [
            'title'         => __('Back To Clients'),
            'route'         =>  'clients.index',
            'icon'          => 'arrow-left'
        ];
        $info  = null;
        $array = [
            'title'         => $PageTitle,
            'route'         => route('app.clients.store'),
            'submit'        =>'Save',
            'type'          => 'create',
            'back_route'    => route('app.clients.index')
        ];
        $data  = User::FORM_INPUTS();
        $data = array_merge($data,$array);
        return view('Clients_Dashboard::action',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('clients.create')) {
            return abort(403);
        }
        $data = $request->all();
        if (request()->has('image')) {
            $data['image']  = imageUpload($request->image, 'clients');
        }
        $data['password']   = bcrypt($request->password);
        $data['type']       = 'client';
        $data['is_active']  = 1;
        $client              = User::create($data);
        return redirect()->route('app.clients.index')->with('success', __('Data Saved Successfully'));
    }

    public function edit($client) {
        if (!permissionCheck('clients.update')) {
            return abort(403);
        }
        $PageTitle = __('Edit Client');
        $ValidaionPath = 'App\Components\Clients\Requests\Dashboard\UpdateRequest';
        $Breadcrumb = [
            [
                'name'      =>  __('All Clients'),
                'route'     =>  'clients.index',
            ],
            [
                'name'      =>  $PageTitle,
                'route'     =>  'clients.edit',
            ],
        ];
        $Button = [
            'title'         => __('Back To Clients'),
            'route'         =>  'clients.index',
            'icon'          => 'arrow-left'
        ];
        $client = User::withTrashed()->find($client);
        $info  = $client;
        $array = [
            'title'         => $PageTitle,
            'route'         => route('app.clients.update',$client->id),
            'method'        =>'PUT',
            'submit'        =>'Update',
            'type'          => 'update',
            'back_route'    => route('app.clients.index')
        ];
        $data  = User::FORM_INPUTS();
        $data = array_merge($data,$array);
        return view('Clients_Dashboard::action',get_defined_vars());
    }

    public function update(UpdateRequest $request, $client) {
        if (!permissionCheck('clients.update')) {
            return abort(403);
        }
        $client = User::withTrashed()->find($client);
        $data = $request->all();
        if (request()->has('image')) {
            $data['image']      = imageUpload($request->image, 'clients', [], false, true, $client->image);
        }else{
            unset($data['image']);
        }
        if ($request->has("password") && !is_null($request->password)) {
            $data['password']   = bcrypt($request->password);
        }else{
            unset($data['password']);
        }
        $data['type']           = 'client';
        $client->update($data);
        return redirect()->route('app.clients.index')->with('success', __('Data Updated Successfully'));
    }

    public function destroy($client) {
        if (!permissionCheck('clients.delete')) {
            return abort(403);
        }
        $client = User::withTrashed()->find($client);
        $client->delete();
        return redirect()->route('app.clients.index')->with('success', __('Data Deleted Successfully'));
    }

    public function deleteForever($client) {
        if (!permissionCheck('clients.delete')) {
            return abort(403);
        }
        $client = User::withTrashed()->find($client);
        DeleteImage($client->image);
        $client->forceDelete();
        return redirect()->back()->with('success', __('Data Deleted Forever Successfully'));
    }

    public function restore($client) {
        if (!permissionCheck('clients.delete')) {
            return abort(403);
        }
        $client = User::withTrashed()->find($client);
        $client->restore();
        return redirect()->back()->with('success', __('Data Restore Successfully'));
    }

    public function is_active($client)
    {
        $client = User::withTrashed()->find($client);
        if ($client->is_active == 0) {
            $client->update(['is_active' => 1]);
        }else{
            $client->update(['is_active' => 0]);
        }
        return redirect()->back()->with('success', __('Status Updated Successfully'));
    }

    public function remove_image($client) {
        $client = User::withTrashed()->find($client);
        DeleteImage($client->image);
        $client->update([
            'image' => null
        ]);
        return response()->json([
            'message' => __('Image Deleted Successfully'),
        ]);
    }
}
