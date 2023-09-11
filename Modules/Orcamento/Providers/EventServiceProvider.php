<?php

namespace Modules\Orcamento\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Orcamento\Events\BudgetUpdated;
use Modules\Orcamento\Listeners\NotifyBudgetUpdated;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        BudgetUpdated::class => [
            NotifyBudgetUpdated::class,
        ],
    ];
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
