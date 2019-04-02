<?php
namespace LaravelChinaCities;

use Illuminate\Support\ServiceProvider;
class LaravelChinaCitiesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $timestamp = date('Y_m_d_His');
        
        $this->publishes([
            __DIR__.'/../migrations/create_cities_table.php' => $this->app->databasePath()."/migrations/{$timestamp}_create_cities_table.php",
        ]);
    }

    public function register()
    {
        # code
    }
}