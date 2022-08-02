<?php

namespace App\Components\Pages\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Components\Pages\Models\Page;
// Requests
use App\Components\Pages\Requests\Dashboard\StoreRequest;
use App\Components\Pages\Requests\Dashboard\UpdateRequest;

class PagesController extends Controller {

    public function index() {
        if (!permissionCheck('pages.view')) {
            return abort(403);
        }
        $PageTitle = __('All Pages');
        $Breadcrumb = [
            [
                'name'  =>  $PageTitle,
                'route' =>  'pages.index',
            ],
        ];

        if (permissionCheck('pages.create')) {
            $Button = [
                'title' => __('Add Page'),
                'route' =>  'pages.create',
                'icon'  => 'plus'
            ];
        }
        $search  = Page::FORM_SEARCH();
        $lists = Page::query();
        if (request()->has('filter') && request('filter') != 0) {
            if (request()->has('title') && !empty(request('title'))) {
                $lists->whereTranslationLike("title","%".request('title')."%");
            }
            if (request()->has('is_active') && !is_null(request('is_active'))) {
                $lists->where('is_active', request('is_active'));
            }
            if (request()->has('created_at') && !empty(request('created_at'))) {
                $lists->whereDate('created_at', request('created_at'));
            }
        }
        $lists = $lists->orderBy('id', "DESC")->paginate();
        return view('Pages_Dashboard::index',get_defined_vars());
    }

    public function create() {
        if (!permissionCheck('pages.create')) {
            return abort(403);
        }
        $PageTitle = __('Add Page');
        $ValidaionPath = 'App\Components\Pages\Requests\Dashboard\StoreRequest';
        $Breadcrumb = [
            [
                'name'      =>  __('All Pages'),
                'route'     =>  'pages.index',
            ],
            [
                'name'      =>  $PageTitle,
                'route'     =>  'pages.create',
            ],
        ];
        $Button = [
            'title'         => __('Back To Pages'),
            'route'         =>  'pages.index',
            'icon'          => 'arrow-left'
        ];
        $info  = null;
        $array = [
            'title'         => $PageTitle,
            'route'         => route('app.pages.store'),
            'submit'        =>'Save',
            'type'          =>'create',
            'back_route'    => route('app.pages.index')
        ];
        $data  = Page::FORM_INPUTS();
        $data = array_merge($data,$array);
        return view('Pages_Dashboard::action',get_defined_vars());
    }

    public function store(StoreRequest $request) {
        if (!permissionCheck('pages.create')) {
            return abort(403);
        }
        $data = $request->all();
        if (request()->has('image')) {
            $data['image']  = imageUpload($request->image, 'pages');
        }
        $data['ar']['slug'] = str_replace(" ","-",$request->ar['title']);
        $data['en']['slug'] = str_replace(" ","-",strtolower($request->en['title']));
        $data['is_delete']  = 1;
        Page::create($data);
        return redirect()->route('app.pages.index')->with('success', __('Data Saved Successfully'));
    }

    public function edit(Page $page) {
        if (!permissionCheck('pages.update')) {
            return abort(403);
        }
        $PageTitle = __('Edit Page');
        $ValidaionPath = 'App\Components\Pages\Requests\Dashboard\UpdateRequest';
        $Breadcrumb = [
            [
                'name'      =>  __('All Pages'),
                'route'     =>  'pages.index',
            ],
            [
                'name'      =>  $PageTitle,
                'route'     =>  'pages.edit',
            ],
        ];
        $Button = [
            'title'         => __('Back To Pages'),
            'route'         =>  'pages.index',
            'icon'          => 'arrow-left'
        ];
        $info  = $page;
        $array = [
            'title'         => $PageTitle,
            'route'         => route('app.pages.update',$page->id),
            'method'        =>'PUT',
            'submit'        =>'Update',
            'type'          =>'update',
            'back_route'    => route('app.pages.index')
        ];
        $data  = Page::FORM_INPUTS();
        $data = array_merge($data,$array);
        return view('Pages_Dashboard::action',get_defined_vars());
    }

    public function update(UpdateRequest $request, Page $page) {
        if (!permissionCheck('pages.update')) {
            return abort(403);
        }
        $data = $request->all();
        if (request()->has('image')) {
            $data['image']  = imageUpload($request->image, 'pages', [], false, true, $page->image);
        }else{
            unset($data['image']);
        }
        $data['ar']['slug'] = str_replace(" ","-",$request->ar['title']);
        $data['en']['slug'] = str_replace(" ","-",strtolower($request->en['title']));
        $page->update($data);
        return redirect()->route('app.pages.index')->with('success', __('Data Updated Successfully'));
    }

    public function destroy($page) {
        if (!permissionCheck('pages.delete')) {
            return abort(403);
        }
        $page = Page::find($page);
        if ($page->id == 1 || $page->id == 2 || $page->id == 3) {
            return redirect()->back()->with('error', __("You Can't Delete This Page"));
        }
        if ($page->is_delete == 0) {
            return redirect()->back()->with('error', __("You Can't Delete This Page"));
        }
        DeleteImage($page->image);
        $page->delete();
        return redirect()->route('app.pages.index')->with('success', __('Data Deleted Successfully'));
    }

    public function active($page)
    {
        $page = Page::find($page);
        if ($page->is_active == 0) {
            $page->update(['is_active'=>1]);
        }else{
            $page->update(['is_active'=>0]);
        }
        return redirect()->route('app.pages.index')->with('success', __("Data Updated Successfully"));
    }

    public function remove_image($page) {
        $page = Page::find($page);
        DeleteImage($page->image);
        $page->update([
            'image' => null
        ]);
        return response()->json([
            'message' => __('Image Deleted Successfully'),
        ]);
    }
}
