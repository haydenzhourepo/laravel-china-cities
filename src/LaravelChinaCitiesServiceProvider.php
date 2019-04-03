<?php
namespace HaydenZhou\LaravelChinaCities;

use Illuminate\Support\ServiceProvider;
use LaravelChinaCities\Commands\ImportCity;
class LaravelChinaCitiesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $timestamp = date('Y_m_d_His');
        
        $this->publishes([
            __DIR__.'/../migrations/create_cities_table.php' => $this->app->databasePath()."/migrations/{$timestamp}_create_cities_table.php",
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                ImportCity::class,
            ]);
        }
    }

    public function register()
    {
        # code
    }
}