<?php

namespace App\Providers;

use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }

        Builder::macro('search', function($field, $string){
            return $string ? $this->where($field, 'like', '%'.$string.'%') : $string;
        });

        Builder::macro('filter', function($field, $integer){
            return $integer ? $this->where($field, 'like', $integer) : $integer;
        });

        // Paginator::useBootstrap();
        Paginator::useBootstrap();
    }
}
