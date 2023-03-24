<?php

namespace App\Providers;

use App\Support\Sidebar\Sidebar;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Language\Models\Language;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(120);

//        $this->loadviews();
        //$this->loadJsonTranslations();
        $this->loadMigration();
    }

    private function loadviews()
    {
        $modules_glob = glob(app_path().'/Modules/**/resources/views');

        foreach ($modules_glob as $value) {

            $str = explode('/', substr($value, strpos($value, 'Modules')));

            $this->loadViewsFrom($value, $str[1]);
        }
    }

    private function loadMigration()
    {
        $migration_glob = glob(app_path().'/Modules/**/database/migrations/*.php');
        foreach ($migration_glob as $file) {
            $file = edit_separator($file);
            $this->loadMigrationsFrom($file);
        }
    }
}
