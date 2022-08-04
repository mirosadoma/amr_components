<?php

namespace Amr\AmrComponents\Console\Commands;

use Illuminate\Console\Command;

class FComponent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'component:create {name=default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Component';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected $translate = false;

    protected $is_editor = false;

    protected $is_file = false;

    protected $inputs_count = 0;

    protected $inputs = [];

    protected $model_inputs = [];

    protected $requests_validation_inputs = [];

    protected $requests_attributes_inputs = [];

    protected $model_translatedAttributes = "";

    protected $stubMap = [
        'Controllers' => [
            'type'=>'controller',
            'files'=>[
                ['dashboard'=>'Controllers/Dashboard/DashboardController.php'],
                ['locales'=>'Controllers/Dashboard/LocalesController.php'],
                ['site'=>'Controllers/Site/SiteController.php'],
                ['api'=>'Controllers/Api/ApiController.php'],
            ]
        ],
        'Database' => [
            'type'=>'database',
            'files'=>[
                ['migration'=>'Database/migrations/Migration.php'],
                ['seeder'=>'Database/seeders/Seeders.php'],
            ]
        ],
        'Models' => [
            'type'=>'model',
            'files'=>[
                'Models/model.php',
            ]
        ],
        'Requests'=>[
            'type'=>'requests',
            'files'=>[
                ['dashboard'=>'Requests/Dashboard/StoreRequest.php'],
                ['dashboard'=>'Requests/Dashboard/UpdateRequest.php'],
                ['api'=>'Requests/Api/StoreRequest.php'],
                ['api'=>'Requests/Api/UpdateRequest.php'],
            ]
        ],
        'Resources'=>[
            'type'=>'resources',
            'files'=>[
                'Resources/Api/Resource.php',
            ]
        ],
        'Views' => [
            'type'=>'view',
            'files'=>[
                'Views/Dashboard/resourses/main.php',
                'Views/Dashboard/resourses/permission.php',
                'Views/Dashboard/resourses/rightNavbar.php',
                'Views/Dashboard/resourses/top.php',
                'Views/Dashboard/views/index.blade.php',
                'Views/Dashboard/views/action.blade.php',
                'Views/Dashboard/views/locales.blade.php',
                'Views/Site/views/index.blade.php',
                'Views/Site/views/create.blade.php',
                'Views/Site/views/edit.blade.php',
                'Views/Lang/ar.json',
            ]
        ],
        'Routes' => [
            'type'=>'route',
            'files'=>[
                'Route/admin.php',
                'Route/api.php',
                'Route/web.php',
            ]
        ]
    ];

    public function handle() {
        if($this->argument('name') == 'default') {
            $this->info('Component Name Missing');
        } else {
            if (!preg_match('~^\p{Lu}~u', $this->argument('name'))) {
                $this->info("------------------");
                $this->info("Note :- Your Component Should Has First Letter UberCase");
                $this->info("------------------");
                die;
            }

            if (!str_ends_with($this->argument('name'),'s')) {
                $this->info("------------------");
                $this->info("Note :- Your Component Should Ends With 's'");
                $this->info("------------------");
                die;
            }
            $ask = $this->ask('What Is The Count Of Your Inputs');
            if(strtolower($ask) == null || !is_numeric($ask)) {
                $this->info("Not Choosen");
                $this->info("------------------");
                die;
            }
            $this->inputs_count = $ask;
            for ($i=1; $i <= $this->inputs_count; $i++) {
                $ask1 = $this->ask('Please Write The Name Of Input ' . $i . ' :-');
                if(strtolower($ask1) == null) {
                    $this->info("Not Choosen");
                    $this->info("------------------");
                    die;
                }
                $types = ['string', 'integer', 'tinyInteger', 'bigInteger', 'float', 'double', 'decimal', 'text', 'longText', 'date', 'dateTime', 'time', 'timestamp', 'json'];
                $ask2 = $this->ask('Please Write The Type Of Input (' . strtolower($ask1) . ') [ string, integer, tinyInteger, bigInteger, float, double, decimal, text, longText, date, dateTime, time, timestamp, json ] :-');
                if($ask2 == null || !in_array($ask2, $types) ){
                    $this->info("Type Not Found Please Choose From Up");
                    $this->info("------------------");
                    die;
                }
                if (!in_array($ask2, ['integer', 'tinyInteger', 'bigInteger', 'float', 'double', 'decimal', 'date', 'dateTime', 'time', 'timestamp'])) {
                    $ask3 = $this->ask('Please Write If The Input (' . strtolower($ask1) . ') Is Translation Or Not [ y , n ] :-');
                    if(strtolower($ask3) == null || !in_array(strtolower($ask3), ['y','n']) ){
                        $this->info("Answer Not Found Please Choose From Up");
                        $this->info("------------------");
                        die;
                    }
                }else{
                    $ask3 = "n";
                }
                if ($ask2 == "text" || $ask2 == "longText") {
                    $ask_editor = $this->ask('Do You Want Editor For This Input (' . strtolower($ask1) . ') [ y, n ] :-');
                    if(strtolower($ask_editor) == null || !in_array(strtolower($ask_editor), ['y','n']) ){
                        $this->info("Answer Not Found Please Choose From Up");
                        $this->info("------------------");
                        die;
                    }
                    if($ask_editor == "y"){
                        $this->model_inputs['editor'] = true;
                        if(strtolower($ask3) == "y"){

                $types = ['string', 'text', 'longText', 'date', 'dateTime', 'time', 'timestamp', 'json'];

                            $type = "";
                            if (in_array(strtolower($ask2), ['integer', 'tinyInteger', 'bigInteger', 'float', 'double', 'decimal'])) {
                                $type = "number";
                            }elseif (in_array(strtolower($ask2), ['string', 'text', 'longText'])) {
                                $type = "textarea";
                            }else{
                                $type = strtolower($ask2);
                            }
                            $this->model_inputs['lang']['inputs'][] = [
                                'label' => ucfirst($ask1),
                                'name'  => strtolower($ask1),
                                'type'  => $type,
                                'value' => '',
                                'editor' => true,
                            ];
                            $this->is_editor = true;
                        }else{
                            $this->model_inputs['inputs'][] = [
                                'label' => ucfirst($ask1),
                                'name'  => strtolower($ask1),
                                'type'  => (in_array(strtolower($ask2), ['integer', 'tinyInteger', 'bigInteger', 'float', 'double', 'decimal'])) ? "number" : strtolower($ask2),
                                'value' => '',
                                'editor' => true,
                            ];
                        }
                    }
                }
                $ask_file_type = '';
                if (strtolower($ask2) == "string") {
                    $ask_file_upload = $this->ask('If This Input (' . strtolower($ask1) . ') Is File Upload ? [ y , n ] :-');
                    if(strtolower($ask_file_upload) == null || !in_array(strtolower($ask_file_upload), ['y','n']) ){
                        $this->info("Answer Not Found Please Choose From Up");
                        $this->info("------------------");
                        die;
                    }
                    if($ask_file_upload == "y"){
                        $ask_file_type = $this->ask('If This File Upload (' . strtolower($ask1) . ') Is :-  [ image , file ] :-');
                        if(strtolower($ask_file_type) == null || !in_array(strtolower($ask_file_type), ['image','file']) ){
                            $this->info("Answer Not Found Please Choose From Up");
                            $this->info("------------------");
                            die;
                        }
                        $ask_file_multiple = $this->ask('If This File Upload (' . strtolower($ask1) . ') Is Multiple :-  [ y , n ] :-');
                        if(strtolower($ask_file_multiple) == null || !in_array(strtolower($ask_file_multiple), ['y','n']) ){
                            $this->info("Answer Not Found Please Choose From Up");
                            $this->info("------------------");
                            die;
                        }
                        $this->model_inputs['files'][] = [
                            'label'         => ucfirst($ask1),
                            'name'          => strtolower($ask1),
                            'class'         => strtolower($ask1).'_'.strtolower($ask_file_type), // to call file input by class
                            'type'          => 'file', // image/video/file
                            'path'          => strtolower($ask_file_type).'_path', // to call file path
                            'delete_url'    => strtolower($this->argument('name')).'/remove_'.strtolower($ask_file_type).'/', // to delete file
                            'multiple'      => $ask_file_multiple == "y" ? true : false, // file/files
                        ];
                        $this->is_file = true;
                    }
                }

                $this->inputs[] = [
                    'name'=>strtolower($ask1),
                    'type'=>strtolower($ask2),
                    'trans'=>strtolower($ask3),
                ];

                if ($this->is_editor == false && $this->is_file == false) {
                    $type = "";
                    if (in_array(strtolower($ask2), ['integer', 'tinyInteger', 'bigInteger', 'float', 'double', 'decimal'])) {
                        $type = "number";
                    }elseif (in_array(strtolower($ask2), ['string', 'text', 'longText'])) {
                        $type = "text";
                    }else{
                        $type = strtolower($ask2);
                    }
                    if(strtolower($ask3) == "y"){
                        $this->model_inputs['lang']['inputs'][] = [
                            'label' => ucfirst($ask1),
                            'name'  => strtolower($ask1),
                            'type'  => $type,
                            'value' => '',
                        ];
                    }else{
                        $this->model_inputs['inputs'][] = [
                            'label' => ucfirst($ask1),
                            'name'  => strtolower($ask1),
                            'type'  => $type,
                            'value' => '',
                        ];
                    }
                }
                $this->is_editor    = false;
                $this->is_file      = false;


                $types = ['integer', 'tinyInteger', 'bigInteger', 'float', 'double', 'decimal', 'date', 'dateTime', 'time', 'timestamp', 'json'];
                // Requests Validation Inputs
                if (in_array($ask2, ['string', 'text', 'longText', 'date', 'dateTime', 'time', 'timestamp'])) {
                    if (strtolower($ask2) == "string" && strtolower($ask_file_type) == 'image') {
                        $this->requests_validation_inputs['normal'][strtolower($ask1)] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg';
                    }elseif (strtolower($ask2) == "string" && strtolower($ask_file_type) == 'file') {
                        $this->requests_validation_inputs['normal'][strtolower($ask1)] = 'nullable|mimes:pdf';
                    }else{
                        if (strtolower($ask3) == "y") {
                            foreach(app_languages() as $key => $value){
                                $this->requests_validation_inputs['trans'][$key][$key.".".strtolower($ask1)] = "required|string|between:2,100";
                            }
                        }else{
                            $this->requests_validation_inputs['normal'][strtolower($ask1)] = 'required|string|between:2,100';
                        }
                    }
                }elseif(in_array($ask2, ['integer', 'tinyInteger', 'bigInteger', 'float', 'double', 'decimal'])){
                    $this->requests_validation_inputs['normal'][strtolower($ask1)] = 'required|min:6|max:255';
                }else{
                    $this->requests_validation_inputs['normal'][strtolower($ask1)] = 'required';
                }
                if (strtolower($ask3) == "y") {
                    $this->requests_attributes_inputs['trans'][strtolower($ask1)] = __(ucfirst($ask1));
                }else{
                    $this->requests_attributes_inputs['normal'][strtolower($ask1)] = __(rtrim($this->argument('name'),'s') . ' ' . ucfirst($ask1));
                }
                $this->model_translatedAttributes .= strtolower($ask2).",";
            }
            $this->info('------------------');
            $this->createComponent();
        }
    }

    protected function createComponent() {
        $name    = $this->argument('name');
        $stubMap = $this->stubMap;
        $map     = [];
        // Check Map
        // foreach($stubMap as $key=>$val) {
        //     $ask = $this->ask('You Want '.$key.' ? [Y | N]');
        //     if(lcfirst($ask) == null) {
        //         $ask = $this->ask('Choose [Y | N] Please , You Want '.$key.' ? [Y | N]');
        //     }
        //     if(lcfirst($ask) == null) {
        //         $this->info("Not Choosen");
        //         $this->info("------------------");
        //         die;
        //     }
        //     if(lcfirst($ask) != 'y') {
        //         $map[] = $key;
        //     }
        // }
        // foreach($map as $val) {
        //     unset($stubMap[$val]);
        // }
        foreach($this->inputs as $input){
            if ($input['trans'] == 'y') {
                $this->translate = true;
            }
        }
        // $ask = $this->ask('You Want Make Translate ? [Y | N]');
        // if(lcfirst($ask) == null) {
        //     $this->info("Not Choosen");
        //     $this->info("------------------");
        //     die;
        // }
        // if(lcfirst($ask) == 'y') {
        //     $this->translate = true;
        // }
        if (count($stubMap) == 0) {
            $this->info("Component Create Stop");
            die;
        }
        $this->createDirectories($stubMap);
        $this->info($name.' Component Created');
        die;
    }

    protected function createDirectories($map) {
        if (!is_dir($directory = app_path('Components'))) {
            mkdir($directory, 0755, true);
        }
        $check_name = false;

        if (!is_dir($directory = app_path('Components').'/'.$this->argument('name'))) {
            mkdir($directory, 0755, true);
        } else {
            $check_name = true;
        }

        if($check_name == true) {
            $ask = $this->ask('This Component Name Is Found Do Yo Want Replace This ? [Y | N]');
            if(lcfirst($ask) == 'y') {
               $this->exportComponent($map);
            } else {
                $this->info('Component Create Stop');
                die;
            }
        } else {
            $this->exportComponent($map);
        }

    }

    protected function compileStub($type='') {
        $directory      = 'App\Components';
        if($type == 'Provider') {
            return str_replace(
                ['{{namespace}}','{{ComponentPath}}'],
                [$directory,$directory],
                file_get_contents(__DIR__.'/options/provider.stubs')
            );
        } else if($type == 'helpers') {
            return file_get_contents(__DIR__.'/options/helpers.stubs');
        } else {
            return file_get_contents(__DIR__.'/options/controller.stubs');
        }
    }

    protected function exportComponent($stubMap) {
        foreach ($stubMap as $key => $value) {
            if($value['type'] == 'controller') {
                $this->controllerFunction($value['files']);
            } else if($value['type'] == 'database') {
                $this->databaseFunction($value['files']);
            } else if($value['type'] == 'model') {
                $this->modelFunction($value['files']);
            } else if($value['type'] == 'requests') {
                $this->requestsFunction($value['files']);
            } else if($value['type'] == 'resources'){
                $this->resourcesFunction($value['files']);
            } else if($value['type'] == 'view') {
                $this->viewFunction($value['files'],$key.'.stub');
            } else if($value['type'] == 'route'){
                $this->routeFunction($value['files']);
            }
       }
       return true;
    }

    protected function controllerFunction($value) {
        $path = app_path('Components').'/'.$this->argument('name');
        foreach($value as $val) {
            if (isset($val['dashboard'])) {
                $dir = explode('/',$val['dashboard']);
                unset($dir[count($dir)-1]);
                $dir = implode('/',$dir);
                if (!is_dir($directory = $path.'/'.$dir)) {
                    mkdir($directory, 0755, true);
                }
                file_put_contents(
                    $path.'/'.$val['dashboard'],
                    $this->compileControllerStub($dir, 'dashboard')
                );
            }elseif(isset($val['locales'])){
                $dir = explode('/',$val['locales']);
                unset($dir[count($dir)-1]);
                $dir = implode('/',$dir);
                if (!is_dir($directory = $path.'/'.$dir)) {
                    mkdir($directory, 0755, true);
                }
                file_put_contents(
                    $path.'/'.$val['locales'],
                    $this->compileControllerStub($dir, 'locales')
                );
            }elseif(isset($val['site'])){
                $dir = explode('/',$val['site']);
                unset($dir[count($dir)-1]);
                $dir = implode('/',$dir);
                if (!is_dir($directory = $path.'/'.$dir)) {
                    mkdir($directory, 0755, true);
                }
                file_put_contents(
                    $path.'/'.$val['site'],
                    $this->compileControllerStub($dir, 'site')
                );
            }elseif(isset($val['api'])){
                $dir = explode('/',$val['api']);
                unset($dir[count($dir)-1]);
                $dir = implode('/',$dir);
                if (!is_dir($directory = $path.'/'.$dir)) {
                    mkdir($directory, 0755, true);
                }
                file_put_contents(
                    $path.'/'.$val['api'],
                    $this->compileControllerStub($dir, 'api')
                );
            }
        }
    }

    protected function compileControllerStub($dir, $type) {
        $view_name              = explode('/',$dir);
        $view_name              = $view_name[count($view_name)-1];
        $directory              = 'App\Components\\'.$this->argument('name').'\\'.str_replace('/','\\',$dir);
        $control                = explode('\\',$directory);
        $view                   = $control[2];
        $lcfirst                = lcfirst($view);
        $route                  = $lcfirst;
        $model_name             = rtrim($view,'s');
        $lcfirst                = rtrim($lcfirst,'s');

        $model                  = $control[0].'\\'.$control[1].'\\'.$control[2].'\\Models\\'.$model_name;
        $store_request          = $control[0].'\\'.$control[1].'\\'.$control[2].'\\Requests\\Dashboard\\StoreRequest';
        $store_request_name     = 'StoreRequest';
        $update_request         = $control[0].'\\'.$control[1].'\\'.$control[2].'\\Requests\\Dashboard\\UpdateRequest';
        $update_request_name    = 'UpdateRequest';
        if ($type == 'dashboard') {
            $controlar_name = "Dashboard";
            return str_replace(
                ['{{namespace}}','{{controlar_name}}','{{view}}','{{route}}','{{model}}','{{lcfirst}}','{{view_name}}','{{model_name}}','{{store_request}}','{{store_request_name}}','{{update_request}}','{{update_request_name}}'],
                [$directory,$controlar_name,$view,$route,$model,$lcfirst,$view_name,$model_name,$store_request,$store_request_name,$update_request,$update_request_name],
                file_get_contents(__DIR__.'/stubs/controllers/dashboard.stub')
            );
        }elseif($type == 'locales'){
            $controlar_name = "Locales";
            return str_replace(
                ['{{namespace}}','{{controlar_name}}','{{view}}','{{route}}','{{model}}','{{lcfirst}}','{{view_name}}','{{model_name}}','{{store_request}}','{{store_request_name}}','{{update_request}}','{{update_request_name}}'],
                [$directory,$controlar_name,$view,$route,$model,$lcfirst,$view_name,$model_name,$store_request,$store_request_name,$update_request,$update_request_name],
                file_get_contents(__DIR__.'/stubs/controllers/locales.stub')
            );
        }elseif($type == 'site'){
            $controlar_name = "Site";
            return str_replace(
                ['{{namespace}}','{{controlar_name}}','{{view}}','{{route}}','{{model}}','{{lcfirst}}','{{view_name}}','{{model_name}}','{{store_request}}','{{store_request_name}}','{{update_request}}','{{update_request_name}}'],
                [$directory,$controlar_name,$view,$route,$model,$lcfirst,$view_name,$model_name,$store_request,$store_request_name,$update_request,$update_request_name],
                file_get_contents(__DIR__.'/stubs/controllers/site.stub')
            );
        }elseif($type == 'api'){
            $controlar_name = "Api";
            return str_replace(
                ['{{namespace}}','{{controlar_name}}','{{view}}','{{route}}','{{model}}','{{lcfirst}}','{{view_name}}','{{model_name}}','{{store_request}}','{{store_request_name}}','{{update_request}}','{{update_request_name}}'],
                [$directory,$controlar_name,$view,$route,$model,$lcfirst,$view_name,$model_name,$store_request,$store_request_name,$update_request,$update_request_name],
                file_get_contents(__DIR__.'/stubs/controllers/api.stub')
            );
        }
    }

    protected function databaseFunction($value) {
        $path = app_path('Components').'\\'.$this->argument('name');
        foreach($value as $val) {
            if (isset($val['migration'])) {
                $dir = explode('/',$val['migration']);
                unset($dir[count($dir)-1]);
                $dir = implode('/',$dir);
                if (!is_dir($directory = $path.'\\'.$dir)) {
                    mkdir($directory, 0755, true);
                }
                $val = str_replace('Migration',$this->argument('name'),$val['migration']);
                $val = str_replace(
                    $this->argument('name').'.php',
                    date('Y_m_d').'_'.rand(000000,999999).'_create_'.lcfirst($this->argument('name').'_table.php'),
                    $val
                );
                if($this->translate != true) {
                    file_put_contents(
                        $path.'\\'.$val,
                        $this->compileMigrateStub('migrataion',$dir)
                    );
                } else {
                    file_put_contents(
                        $path.'\\'.$val,
                        $this->compileMigrateStub('migrataion',$dir,'_translate')
                    );
                }
            }elseif(isset($val['seeder'])){
                $dir = explode('/',$val['seeder']);
                unset($dir[count($dir)-1]);
                $dir = implode('/',$dir);
                if (!is_dir($directory = $path.'/'.$dir)) {
                    mkdir($directory, 0755, true);
                }
                $val = str_replace('Seeders',$this->argument('name').'Seeder',$val['seeder']);
                file_put_contents(
                    $path.'/'.$val,
                    $this->compileMigrateStub('seeder',$dir)
                );
            }
        }
    }

    protected function compileMigrateStub($type = '', $dir,$translate = '') {
        $inputs = '';
        $inputs_trans = '';
        if ($type == 'migrataion') {
            $name        = 'Create'.$this->argument('name').'Table';
            $table_name  = lcfirst($this->argument('name'));
            $table_id    = rtrim($table_name,'s');
            foreach($this->inputs as $input){
                if ($input['trans'] == "y") {
                    if (in_array($input['type'], ['string', 'text', 'longText', 'date', 'dateTime', 'time', 'timestamp', 'json'])) {
                        $inputs_trans .= '$table->'.$input['type'].'(\''.$input['name'].'\')->nullable();'."\r\n";
                    }else{
                        $inputs_trans .= '$table->'.$input['type'].'(\''.$input['name'].'\')->default(0);'."\r\n";
                    }
                }else{
                    if (in_array($input['type'], ['string', 'text', 'longText', 'date', 'dateTime', 'time', 'timestamp', 'json'])) {
                        $inputs .= '$table->'.$input['type'].'(\''.$input['name'].'\')->nullable();'."\r\n";
                    }else{
                        $inputs .= '$table->'.$input['type'].'(\''.$input['name'].'\')->default(0);'."\r\n";
                    }
                }
            }
            return str_replace(
                ['{{migrate}}','{{table_name}}','{{table_id}}','{{inputs}}','{{inputs_trans}}'],
                [$name,$table_name,$table_id,$inputs,$inputs_trans],
                file_get_contents(__DIR__.'/stubs/migrations/migrations'.$translate.'.stub')
            );
        }else{
            $namespace      = 'App\Components\\'.$this->argument('name').'\\'.str_replace('/','\\',$dir);
            $seeder_name    = $this->argument('name').'Seeder';
            return str_replace(
                ['{{namespace}}','{{seeder_name}}'],
                [$namespace,$seeder_name],
                file_get_contents(__DIR__.'/stubs/migrations/seeders.stub')
            );
        }
    }

    protected function modelFunction($value) {
       $path = app_path('Components').'/'.$this->argument('name');
       foreach($value as $val) {
           $dir = explode('/',$val);
           unset($dir[count($dir)-1]);
           $dir = implode('/',$dir);
           if (! is_dir($directory = $path.'/'.$dir)) {
               mkdir($directory, 0755, true);
           }
           $val = str_replace('model',rtrim($this->argument('name'),'s'),$val);
           if($this->translate != true) {
               file_put_contents(
                   $path.'/'.$val,
                   $this->compileModelStub($dir)
               );
           } else {
               if (!is_dir($directory = $path.'/'.$dir.'/'.'Translation')) {
                   mkdir($directory, 0755, true);
               }
               $val = str_replace('.php','',$val);
               file_put_contents(
                   $path.'/'.$val.'.php',
                   $this->compileModelStub($dir,1,'model')
               );
               file_put_contents(
                   $directory.'/'.rtrim($this->argument('name'),'s').'.php',
                   $this->compileModelStub($dir.'/Translation',1,'model_translate')
               );
           }
       }
    }

    protected function compileModelStub($dir,$translate = 0,$file = '') {
        $namespace              = 'App\Components\\'.$this->argument('name').'\\'.str_replace('/','\\',$dir);
        $component_name         = $this->argument('name');
        $component_id           = rtrim(lcfirst($this->argument('name')),'s');
        $model_name_small       = lcfirst($this->argument('name'));
        $model_name_big         = rtrim($this->argument('name'),'s');
        if($translate == 0) {
            return str_replace(
                ['{{namespace}}','{{component_name}}','{{component_id}}','{{model_name_small}}','{{model_name_big}}','{{model_inputs}}'],
                [$namespace,$component_name,$component_id,$model_name_small,$model_name_big,$this->varexport($this->model_inputs,true)],
                file_get_contents(__DIR__.'/stubs/models/normal/model.stub')
            );
        } else {
            if ($file == "model") {
                return str_replace(
                    ['{{namespace}}','{{component_name}}','{{component_id}}','{{model_name_small}}','{{model_name_big}}','{{model_inputs}}','{{model_translatedAttributes}}'],
                    [$namespace,$component_name,$component_id,$model_name_small,$model_name_big,$this->varexport($this->model_inputs,true),$this->model_translatedAttributes],
                    file_get_contents(__DIR__.'/stubs/models/translate/'.$file.'.stub')
                );
            }else{
                return str_replace(
                    ['{{namespace}}','{{component_name}}','{{component_id}}','{{model_name_small}}','{{model_name_big}}','{{model_translatedAttributes}}'],
                    [$namespace,$component_name,$component_id,$model_name_small,$model_name_big,$this->model_translatedAttributes],
                    file_get_contents(__DIR__.'/stubs/models/translate/'.$file.'.stub')
                );
            }
        }
    }

    protected function varexport($expression, $return=FALSE) {
        $export = var_export($expression, TRUE);
        $patterns = [
            "/array \(/" => '[',
            "/^([ ]*)\)(,?)$/m" => '$1]$2',
            "/=>[ ]?\n[ ]+\[/" => '=> [',
            "/([ ]*)(\'[^\']+\') => ([\[\'])/" => '$1$2 => $3',
        ];
        $export = preg_replace(array_keys($patterns), array_values($patterns), $export);
        if ((bool)$return) return $export; else echo $export;
    }

    protected function requestsFunction($value) {
        $path = app_path('Components').'/'.$this->argument('name');
        foreach($value as $val) {
            if (isset($val['dashboard'])) {
                $dir = explode('/',$val['dashboard']);
                unset($dir[count($dir)-1]);
                $dir = implode('/',$dir);
                if (! is_dir($directory = $path.'/'.$dir)) {
                    mkdir($directory, 0755, true);
                }
                $dir = explode('/',$val['dashboard']);
                $file_name = $dir[2];
                $file_name = str_replace('.php','',$file_name);
                $dir = $dir[0];
               if($this->translate != true) {
                   file_put_contents(
                       $path.'/'.$val['dashboard'],
                       $this->compileRequestsStub($dir,$file_name,0,'dashboard')
                   );
                } else {
                   file_put_contents(
                       $path.'/'.$val['dashboard'],
                       $this->compileRequestsStub($dir,$file_name,1,'dashboard')
                   );
               }
            }elseif (isset($val['api'])) {
                $dir2 = explode('/',$val['api']);
                unset($dir2[count($dir2)-1]);
                $dir2 = implode('/',$dir2);
                if (! is_dir($directory = $path.'/'.$dir2)) {
                    mkdir($directory, 0755, true);
                }
                $dir2 = explode('/',$val['api']);
                $file_name = $dir2[2];
                $file_name = str_replace('.php','',$file_name);
                $dir2 = $dir2[0];
               if($this->translate != true) {
                   file_put_contents(
                       $path.'/'.$val['api'],
                       $this->compileRequestsStub($dir2,$file_name,0,'api')
                   );
                } else {
                   file_put_contents(
                       $path.'/'.$val['api'].'.php',
                       $this->compileRequestsStub($dir2,$file_name,1,'api')
                   );
               }
            }
        }
    }

    protected function compileRequestsStub($dir = '', $file_name = '', $translate = 0, $type = 'dashboard') {

        $component_name         = $this->argument('name');
        if ($type == 'dashboard') {
            $namespace              = 'App\Components\\'.$component_name.'\\'.str_replace('/','\\',$dir).'\\Dashboard';
        }elseif ($type == 'api') {
            $namespace              = 'App\Components\\'.$component_name.'\\'.str_replace('/','\\',$dir).'\\Api';
        }
        $component_id           = rtrim(lcfirst($component_name),'s');
        $model_name_small       = lcfirst($component_name);
        $model_name_big         = rtrim($component_name,'s');
        if($translate == 0) {
            return str_replace(
                ['{{namespace}}','{{component_name}}','{{component_id}}','{{model_name_small}}','{{model_name_big}}','{{file_name}}', '{{requests_validation_inputs}}', '{{requests_attributes_inputs}}'],
                [$namespace,$component_name,$component_id,$model_name_small,$model_name_big,$file_name, $this->varexport($this->requests_validation_inputs['normal'],true), $this->varexport($this->requests_attributes_inputs['normal'],true)],
                file_get_contents(__DIR__.'/stubs/requests/normal/'.$file_name.'.stub')
            );
        } else {
            return str_replace(
                ['{{namespace}}','{{component_name}}','{{component_id}}','{{model_name_small}}','{{model_name_big}}','{{file_name}}', '{{requests_validation_inputs}}', '{{requests_attributes_inputs}}', '{{requests_validation_inputs_trans}}', '{{requests_attributes_inputs_trans}}'],
                [$namespace,$component_name,$component_id,$model_name_small,$model_name_big,$file_name, $this->varexport($this->requests_validation_inputs['normal'],true), $this->varexport($this->requests_attributes_inputs['normal'],true), $this->varexport($this->requests_validation_inputs['trans'],true), $this->varexport($this->requests_attributes_inputs['trans'],true)],
                file_get_contents(__DIR__.'/stubs/requests/translate/'.$file_name.'.stub')
            );
        }
    }

    protected function resourcesFunction($value) {
        $path = app_path('Components').'/'.$this->argument('name');
        foreach($value as $val) {
            $dir = explode('/',$val);
            unset($dir[count($dir)-1]);
            $dir = implode('/',$dir);
            if (! is_dir($directory = $path.'/'.$dir)) {
                mkdir($directory, 0755, true);
            }
            $dir = explode('/',$val);
            $file_name = $dir[2];
            $file_name = str_replace('Resource.php', $this->argument('name').'Resources',$file_name);
            $dir = $dir[0];
            $val = str_replace('Resource.php',$this->argument('name').'Resources',$val);
            file_put_contents(
                $path.'/'.$val.'.php',
                $this->compileResourcesStub($dir,$file_name)
            );
        }
    }

    protected function compileResourcesStub($dir = '', $file_name = '') {
        $component_name         = $this->argument('name');
        $namespace              = 'App\Components\\'.$component_name.'\\'.str_replace('/','\\',$dir).'\\Api';
        return str_replace(
            ['{{namespace}}','{{component_name}}','{{file_name}}'],
            [$namespace,$component_name,$file_name],
            file_get_contents(__DIR__.'/stubs/resources/Resource.stub')
        );
    }

    protected function viewFunction($value,$key) {
       $path = app_path('Components').'/'.$this->argument('name');
       foreach($value as $val) {
           $dir = explode('/',$val);
           $file_name = count($dir) > 3 ? $dir[3] : $dir[2];
           unset($dir[count($dir)-1]);
           $dir = implode('/',$dir);
           if (! is_dir($directory = $path.'/'.$dir)) {
               mkdir($directory, 0755, true);
           }
            file_put_contents(
                $path.'/'.$val,
                $this->compileviewsStub($dir, $file_name)
            );
       }
    }

    protected function compileviewsStub($dir = '', $file_name = '') {
        $dir = explode('/',$dir);
        $file_name2 = '';
        $dir_2 = count($dir) > 2 ? $dir[2] : $dir[1];
        if ($dir_2 == "resourses" && $dir[1] == 'Dashboard') {
            $file_name2 = str_replace('.php', '.stub',$file_name);
            $path = 'Dashboard/resourses/';
            $component_name     = $this->argument('name');
            $model_name_small   = lcfirst($component_name);
            $model_name_big     = rtrim($component_name,'s');
            return str_replace(
                ['{{component_name}}','{{model_name_small}}','{{model_name_big}}'],
                [$component_name,$model_name_small,$model_name_big],
                file_get_contents(__DIR__.'/stubs/views/'.$path.$file_name2)
            );
        }elseif ($dir_2 == "views" && $dir[1] == 'Dashboard') {
            $file_name2 = str_replace('.blade.php', '.stub',$file_name);
            $path = 'Dashboard/views/';
            $component_name     = $this->argument('name');
            $model_name_small   = lcfirst($component_name);
            $model_name_big     = rtrim($component_name,'s');
            $model_obj          = rtrim($model_name_small,'s');
            return str_replace(
                ['{{component_name}}','{{model_name_small}}','{{model_name_big}}','{{model_obj}}'],
                [$component_name,$model_name_small,$model_name_big,$model_obj],
                file_get_contents(__DIR__.'/stubs/views/'.$path.$file_name2)
            );
        }elseif ($dir_2 == "views" && $dir[1] == 'Site') {
            $file_name2 = str_replace('.blade.php', '.stub',$file_name);
            $path = 'Site/views/';
            return file_get_contents(__DIR__.'/stubs/views/'.$path.$file_name2);
        }elseif ($dir[1] == 'Lang') {
            $file_name2 = $file_name;
            $path = 'Lang/';
            $component_name     = $this->argument('name');
            $model_name_big     = rtrim($component_name,'s');
            return str_replace(
                ['{{component_name}}','{{model_name_big}}'],
                [$component_name,$model_name_big],
                file_get_contents(__DIR__.'/stubs/views/'.$path.$file_name2)
            );
        }
    }

    protected function routeFunction($value) {
        $path = app_path('Components').'/'.$this->argument('name');
        foreach($value as $val) {
            $dir = explode('/',$val);
            $file_name = $dir[1];
            unset($dir[count($dir)-1]);
            $dir = implode('/',$dir);
            if (!is_dir($directory = $path.'/'.$dir)) {
                mkdir($directory, 0755, true);
            }
            file_put_contents(
                $path.'/'.$val,
                $this->compileRouteStub($dir.'/'.$val, $file_name)
            );
        }
    }

    protected function compileRouteStub($dir = '',$file_name = '') {
       $nn = str_replace('.php','',$dir);
       $nn = explode('/',$nn);
       $nn = $nn[count($nn)-1];
       if ($file_name == 'admin.php') {
        $directory      = 'App\Components\\'.$this->argument('name').'\Controllers\Dashboard\DashboardController';
       }elseif ($file_name == 'api.php') {
        $directory      = 'App\Components\\'.$this->argument('name').'\Controllers\Api\ApiController';
       }elseif ($file_name == 'web.php') {
        $directory      = 'App\Components\\'.$this->argument('name').'\Controllers\Site\SiteController';
       }
       $directory       = str_replace('.php','',$directory);
       $name            = lcfirst($this->argument('name'));
       $model_obj       = rtrim($name,'s');

       $file_name = str_replace('.php', '.stub',$file_name);
       return str_replace(
           ['{{directory}}','{{name}}','{{model_obj}}'],
           [$directory,$name,$model_obj],
           file_get_contents(__DIR__.'/stubs/route/'.$file_name)
       );
    }

    // protected function resourcesFunction($value) {
    //     dd("resourcesFunction", $value);
    //     $path = app_path('Components').'/'.$this->argument('name');
    //     foreach($value as $val) {
    //         $dir = explode('/',$val);
    //         unset($dir[count($dir)-1]);
    //         $dir = implode('/',$dir);
    //         if (! is_dir($directory = $path.'/'.$dir)) {
    //             mkdir($directory, 0755, true);
    //         }
    //         $dir = explode('/',$dir);
    //         $dir = $dir[1];
    //         file_put_contents(
    //             $path.'/'.$val,
    //             $this->compileResourcesStub($dir)
    //         );
    //     }
    // }

    // protected function compileResourcesStub($dir) {
    //     $name       = $this->argument('name');
    //     $mm         = lcfirst($name);
    //     if($dir == "menu") {
    //         return str_replace(
    //             ['{{name}}','{{Nname}}'],
    //             [$name,$mm],
    //             file_get_contents(__DIR__.'/options/menu.stubs')
    //         );
    //     } else {
    //         return file_get_contents(__DIR__.'/options/style.stubs');
    //     }
    // }
}
