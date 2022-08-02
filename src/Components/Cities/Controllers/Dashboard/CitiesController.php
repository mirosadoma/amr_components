<?php

namespace App\Components\Cities\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Components\Cities\Models\City;
// Requests
use App\Components\Cities\Requests\Dashboard\StoreRequest;
use App\Components\Cities\Requests\Dashboard\UpdateRequest;

class CitiesController extends Controller {

    public function index() {
        if (!permissionCheck('cities.view')) {
            return abort(403);
        }
        $PageTitle = __('All Cities');
        $Breadcrumb = [
            [
                'name'  =>  $PageTitle,
                'route' =>  'cities.index',
            ],
        ];
        if (permissionCheck('cities.create')) {
            $Button = [
                'title' => __('Add City'),
                'route' =>  'cities.create',
                'icon'  => 'plus'
            ];
        }
        $search  = City::FORM_SEARCH();
        $lists = City::query();
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('name') && !empty(request('name'))) {
                $lists->whereTranslationLike("name","%".request('name')."%");
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
        }
        $lists = $lists->orderBy('id', "DESC")->paginate();
        return view('Cities_Dashboard::index',get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('cities.create')) {
            return abort(403);
        }
        $PageTitle = __('Add City');
        $ValidaionPath = 'App\Components\Cities\Requests\Dashboard\StoreRequest';
        $Breadcrumb = [
            [
                'name'      =>  __('All Cities'),
                'route'     =>  'cities.index',
            ],
            [
                'name'      =>  $PageTitle,
                'route'     =>  'cities.create',
            ],
        ];
        $Button = [
            'title'         => __('Back To Cities'),
            'route'         =>  'cities.index',
            'icon'          => 'arrow-left'
        ];
        $info  = null;
        $array = [
            'title'         => $PageTitle,
            'route'         => route('app.cities.store'),
            'submit'        =>'Save',
            'type'          =>'create',
            'back_route'    => route('app.cities.index')
        ];
        $data  = City::FORM_INPUTS();
        $data = array_merge($data,$array);
        return view('Cities_Dashboard::action',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('cities.create')) {
            return abort(403);
        }
        $data = $request->all();
        $city = City::create($data);
        return redirect()->route('app.cities.index')->with('success', __('Data Saved Successfully'));
    }

    public function edit(City $city) {
        if (!permissionCheck('cities.update')) {
            return abort(403);
        }
        $PageTitle = __('Edit City');
        $ValidaionPath = 'App\Components\Cities\Requests\Dashboard\UpdateRequest';
        $Breadcrumb = [
            [
                'name'      =>  __('All Cities'),
                'route'     =>  'cities.index',
            ],
            [
                'name'      =>  $PageTitle,
                'route'     =>  'cities.edit',
            ],
        ];
        $Button = [
            'title'         => __('Back To Cities'),
            'route'         =>  'cities.index',
            'icon'          => 'arrow-left'
        ];
        $info  = $city;
        $array = [
            'title'         => $PageTitle,
            'route'         => route('app.cities.update',$city->id),
            'method'        =>'PUT',
            'submit'        =>'Update',
            'type'          =>'update',
            'back_route'    => route('app.cities.index')
        ];
        $data  = City::FORM_INPUTS();
        $data = array_merge($data,$array);
        return view('Cities_Dashboard::action',get_defined_vars());
    }

    public function update(UpdateRequest $request, City $city) {
        if (!permissionCheck('cities.update')) {
            return abort(403);
        }
        $data = $request->all();
        $city->update($data);
        return redirect()->route('app.cities.index')->with('success', __('Data Updated Successfully'));
    }

    public function destroy(City $city) {
        if (!permissionCheck('cities.delete')) {
            return abort(403);
        }
        if ($city->users->count()) {
            return redirect()->back()->with('error', __("You Can't Delete This City"));
        }
        $city->delete();
        return redirect()->route('app.cities.index')->with('success', __('Data Deleted Successfully'));
    }
}
