<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Builder;
use App\Support\NotificationFailureContext;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(NotificationFailureContext::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('search', function($field, $string){
            return $string ? $this->where($field, 'like', '%'.$string.'%') : $this;
        });

        Schema::defaultStringLength(191);
    }
}
