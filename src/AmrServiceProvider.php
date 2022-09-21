<?php

namespace Amr\AmrComponents;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Translation\Translator;
use Illuminate\Support\Str;

// Commands
use App\Http\Controllers\Dashboard\Auth\AuthController as DashboardAuthController;
use App\Http\Controllers\Dashboard\MainController as DashboardMainController;
use App\Http\Controllers\Site\Auth\AuthController as SiteAuthController;
use App\Http\Controllers\Site\MainController as SiteMainController;

use Amr\AmrComponents\Console\Commands\FComponent;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

use Illuminate\Contracts\Http\Kernel;
use Amr\AmrComponents\Middlewares\ActiveMiddleware;
use Amr\AmrComponents\Middlewares\AdminMiddleware;
use Amr\AmrComponents\Middlewares\ApiLang;
use Amr\AmrComponents\Middlewares\MaintenanceMiddleware;
use Amr\AmrComponents\Middlewares\RoleMiddleware;
use Amr\AmrComponents\Middlewares\UserVerfyMiddleware;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Config;

class AmrServiceProvider extends ServiceProvider {

    protected $Namespace = 'App\Components';
    protected $API_version = 'api/v1/';
    protected $site_middleware = [
        'web',
        'maintenance',
        'localize' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
        'localizationRedirect' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
        'localeSessionRedirect' => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
        'localeViewPath' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class
    ];
    protected $admin_middleware = [
        'web',
        'admin',
        'localize' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
        'localizationRedirect' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
        'localeSessionRedirect' => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
        'localeViewPath' => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class
    ];

    protected $commands = [
        FComponent::class,
    ];

    public function register() {
        $this->commands($this->commands);
    }
    public function boot() {

        Schema::defaultStringLength(191);
        date_default_timezone_set('Asia/Riyadh');
        Paginator::defaultView('pagination::pagination');
        Paginator::defaultSimpleView('pagination::pagination');

        $this->loadHelpers();
        $this->_loadGuards_();
        $this->_loadviews_();
        $this->_loadJsonTranslations_();
        $this->_loadMigration_();
        $this->_loadSeeders_();
        $this->OverrideTranslations();

        $this->loadWebRoutesDashboard();
        $this->loadWebRoutesSite();
        $this->loadApiRoute();

        if ($this->app->runningInConsole()) {
            // $files = glob(database_path('migrations') . '/*');
            // //Loop through the file list.
            // foreach($files as $file){
            //     //Make sure that this is a file and not a directory.
            //     if(is_file($file)){
            //         //Use the unlink function to delete the file.
            //        unlink($file);
            //     }
            // }

            // $files_models = glob(app_path('Models') . '/*');
            // //Loop through the file list.
            // foreach($files_models as $files_model){
            //     //Make sure that this is a file and not a directory.
            //     if(is_file($files_model)){
            //         //Use the unlink function to delete the file.
            //         unlink($files_model);
            //     }
            // }

            $this->publishes([
                __DIR__.'/assets' => public_path('/'),
                __DIR__.'/views/admin' => resource_path('views/admin'),
                __DIR__.'/views/emails' => resource_path('views/emails'),
                __DIR__.'/views/errors' => resource_path('views/errors'),
                __DIR__.'/views/vendor' => resource_path('views/vendor'),
                __DIR__.'/views/site' => resource_path('views/site'),
                __DIR__.'/Controllers' => app_path('Http/Controllers'),
                __DIR__.'/Components' => app_path('Components'),
                __DIR__.'/Model' => app_path('/Models'),
                __DIR__.'/Helpers' => app_path('/Helpers'),
                __DIR__.'/Requests' => app_path('/Http/Requests'),
                __DIR__.'/Migrations' => database_path('/migrations'),
                __DIR__.'/Config' => config_path('/'),
                __DIR__.'/Lang' => resource_path('lang'),
            ], 'amr_components');
        }

        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('active', ActiveMiddleware::class);
        $router->aliasMiddleware('admin', AdminMiddleware::class);
        $router->aliasMiddleware('maintenance', MaintenanceMiddleware::class);
        $router->aliasMiddleware('role', RoleMiddleware::class);
        $router->aliasMiddleware('user_verfy', UserVerfyMiddleware::class);
        $router->pushMiddlewareToGroup('api', ApiLang::class);

        // if (request()->is('*app*')) {
        //     view()->addNamespace('DCommon', _fixDirSeparator(__DIR__ . '/Common/View/Dashboard/views'));
        // } else {
        //     view()->addNamespace('SCommon', _fixDirSeparator(__DIR__ . '/Common/View/Site/views'));
        // }
    }

    private function _loadGuards_() {
        Config::set('auth.guards.admin', [
            'driver' => 'session',
            'provider' => 'admins',
        ]);

        // Will use the EloquentUserProvider driver with the Admin model
        Config::set('auth.providers.admins', [
            'driver' => 'eloquent',
            'model' => \App\Models\Admin::class,
        ]);
    }

    private function _loadSeeders_() {
        $db_path = database_path('seeders');
        if (is_dir($db_path.'\DatabaseSeeder.php')) {
            unlink($db_path.'\DatabaseSeeder.php');
        }
        fopen(database_path('/seeders/DatabaseSeeder.php'), "w");
        file_put_contents(
            database_path('/seeders/').'DatabaseSeeder.php',
            file_get_contents(__DIR__ . '/DatabaseSeeder.php'),
        );
    }

    private function loadHelpers() {
        include __DIR__ . '/Helpers/MyFatoora.php';
        include __DIR__ . '/Helpers/buttons.php';
        include __DIR__ . '/Helpers/helper.php';
        include __DIR__ . '/Helpers/image.php';
        include __DIR__ . '/Helpers/inputs.php';
        include __DIR__ . '/helpers.php';
    }

    private function _loadviews_() {
        $components = glob(app_path() . '/Components/**');
        foreach ($components as $component) {
            $path = explode('/',$component);
            $component = $path[count($path) -1 ];
            $this->loadViewsFrom(app_path() . '/Components/'.$component.'/Views/Dashboard/views', $component.'_Dashboard');
            $this->loadViewsFrom(app_path() . '/Components/'.$component.'/Views/Site/views', $component.'_Site');
        }
        $this->loadViewsFrom(app_path() . "/Helpers/View/Dashboard", 'INPUTS');
    }

    private function _loadJsonTranslations_() {
        $components = glob(app_path() . '/Components/**');
        foreach ($components as $component) {
            $path = explode('/',$component);
            $component = $path[count($path) -1 ];
            $this->loadJsonTranslationsFrom(app_path() . '/Components/'.$component.'/Views/Lang');
        }
    }

    private function _loadMigration_() {
        $migration_glob = glob(app_path() . '/Components/**/Database/migrations/*.php');
        foreach ($migration_glob as $file) {
            $file = editSeparator($file);
            $this->loadMigrationsFrom($file);
        }
    }

    public function OverrideTranslations (){
        $this->app->extend('translator', function (Translator $e) {
            return new class ($e->getLoader(), app()->getLocale()) extends Translator
            {
                public $notTranslated = [];
                function get($key, array $replace = [], $locale = null, $fallback = true)
                {
                    $res = parent::get($key, $replace, $locale, $fallback);
                    if ($res == $key && Request()->is("*app*") && (config('app.debug') === true) && app()->getLocale() == "ar") {
                        $this->notTranslated[Str::slug($key)] = $key;
                        return  "*$key*";
                    }else{
                        return $res;
                    }
                }
            };
        });
    }

    public function authFrontRoute() {
        if (request()->is('*app*') || request()->is('api*')) {
            return;
        }
        $site = Route::middleware($this->site_middleware)->prefix(LaravelLocalization::setLocale().'/');
        $site->group(function () {
            Route::get('login', [SiteAuthController::class, 'loginPage'])->name('site.login');// Done
            Route::post('login', [SiteAuthController::class, 'loginAuth'])->name('site.loginAuth');// Done
            Route::get('resend_code', [SiteAuthController::class, 'resend_codePage'])->name('site.resend_code');// Done
            Route::get('verification_code', [SiteAuthController::class, 'verification_codePage'])->name('site.verification_code');// Done
            Route::post('verfy_code', [SiteAuthController::class, 'verfy_code'])->name('site.verfy_code');// Done
            Route::get('signup', [SiteAuthController::class, 'signupPage'])->name('site.signup');// Done
            Route::post('signup', [SiteAuthController::class, 'signupAuth'])->name('site.signupAuth');// Done
            Route::get('forget', [SiteAuthController::class, 'forgetPage'])->name('site.forget');// Done
            Route::post('forget', [SiteAuthController::class, 'forgetAuth'])->name('site.forgetAuth');// Done
            Route::get('reset_password/{token}', [SiteAuthController::class, 'reset_passwordPage'])->name('site.reset_password');// Done
            Route::post('reset_password', [SiteAuthController::class, 'reset_passwordAuth'])->name('site.reset_passwordAuth');// Done
            Route::get('logout', [SiteAuthController::class, 'logout'])->name('site.logout');// Done
        });
        $site->middleware(['maintenance','user_verfy'])->prefix(LaravelLocalization::setLocale().'/')->group(function () {
            Route::get('/', [SiteMainController::class, 'index'])->name('home');// Done
        });
        return $site;
    }

    public function authDashboardRoute() {
        if (!request()->is('*app*')) {
            return;
        }
        $dashboard = Route::middleware('web')->prefix(LaravelLocalization::setLocale().'/');
        $dashboard->group(function () {
            Route::get('/', [SiteMainController::class, 'index'])->name('home');// Done
            Route::get('/app/login', [DashboardAuthController::class, 'loginPage'])->name('login');// Done
            Route::post('/app/login', [DashboardAuthController::class, 'loginAuth'])->name('loginAuth');// Done
            Route::post('/app/logout', [DashboardAuthController::class, 'logout'])->name('logout');// Done
        });
        $dashboard->middleware($this->admin_middleware)->prefix(LaravelLocalization::setLocale().'/app')->name('app.')->group(function () {
            Route::get('/', [DashboardMainController::class, 'index'])->name('dashboard');// Done
            Route::post('/fast_trans', [DashboardMainController::class, 'fast_trans'])->name('fast_trans');// Done
            // Route::get('/get_year/{year}', [DashboardMainController::class, 'get_year'])->name('get_year');// Done
            Route::get('logout', [DashboardAuthController::class, 'logout'])->name('logout');// Done
        });
        return $dashboard;
    }

    public function loadWebRoutesSite() {
        if (request()->is('*app*') || request()->is('*api*')) {
            return;
        }
        Route::get('/maintenance', [DashboardMainController::class, 'maintenance'])->name('maintenance');// Done
        $site = $this->authFrontRoute();
        $site->middleware(['user_verfy'])->group(function () use($site) {
            foreach (glob(app_path() . '/Components/**/Route/web.php') as $file) {
                $site->group($file);
            }
        });
        return $site;
    }

    public function loadWebRoutesDashboard() {
        if (!request()->is('*app*')) {
            return;
        }
        Route::get('/maintenance', [DashboardMainController::class, 'maintenance'])->name('maintenance');// Done
        $dashboard = $this->authDashboardRoute();
        foreach (glob(app_path() . '/Components/**/Route/admin.php') as $file) {
            $dashboard->group($file);
        }
        return $dashboard;
    }

    public function loadApiRoute() {
        if (!request()->is('api*')) {
            return;
        }
        $api = Route::group([], function () {
            Route::fallback(function () {
                return abort("404");
            });
            // Auth
            Route::post('register',[AuthController::Class,'register']); // done
            Route::post('login',[AuthController::Class,'login']); // done
            Route::post('resend_code',[AuthController::Class,'resend_code']); // done
            Route::post('check',[AuthController::Class,'check']); // done
            Route::post('forget',[AuthController::Class,'forget']); // done
            Route::post('reset',[AuthController::Class,'reset']); // done
            // Main
            Route::get('homeapp',[MainController::Class,'index']); // done
            Route::get('welcome_content',[MainController::Class,'welcome_content']); // done
            Route::get('get_logo',[MainController::Class,'get_logo']); // done
            Route::post('search',[MainController::Class,'search']); // done
        });

        $api->middleware('api')->group(function () use($api) {
            foreach (glob(app_path() . '/Components/**/Route/api.php') as $file) {
                $api->group($file);
            }
        });
        return $api;
    }
}
