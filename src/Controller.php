<?php

namespace Amr\AmrComponents;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use \App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct() {
        // $this->setViewPath();
    }

    // private function setViewPath() {
    //     $_this = new \ReflectionClass($this);
    //     $filename = $_this->getFilename();
    //     $basePath = str_replace(substr($filename, strpos($filename, 'Controllers')), '', $filename);
    //     $path_end = 'Site';
    //     if (strpos($filename, _fixDirSeparator('Controllers\Dashboard'))) {
    //         $path_end = 'Dashboard';
    //     }
    //     foreach (glob(app_path() . '/Components/**') as $component) {
    //         $path = explode('/',$component);
    //         $component = $path[count($path) -1 ];
    //         view()->addNamespace($component, app_path("/Components/$component/Views/$path_end/views"));
    //     }
    //     view()->addNamespace('INPUTS', app_path() . "/Helpers/View/$path_end");
    //     view()->addNamespace('this', _fixDirSeparator($basePath . 'Views/' . $path_end . '/views'));
    // }
}
