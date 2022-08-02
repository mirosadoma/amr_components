<?php

namespace App\Components\Pages\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Models
use App\Components\Pages\Models\Page;
// Requests
use App\Components\Pages\Requests\Dashboard\StoreRequest;
use App\Components\Pages\Requests\Dashboard\UpdateRequest;

class PagesController extends Controller {

    public function show($page) {
        if (is_numeric($page)) {
            $page = Page::findOrFail($page);
        }else{
            $page = Page::whereTranslationLike('slug', $page)->firstOrFail();
        }
        return view('Pages_Site::show',get_defined_vars());
    }
}