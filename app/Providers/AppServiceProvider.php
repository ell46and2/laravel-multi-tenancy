<?php

namespace App\Providers;

use App\Tenant\Manager;
use App\Tenant\Observers\TenantObserver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // See running queries
        // \DB::listen(function($sql) {
        //     dump($sql->sql);
        // });

        /*
        The singleton method binds a class or interface into the container that should only be resolved one time. Once a singleton binding is resolved, the same object instance will be returned on subsequent calls into the container:
         */
        $this->app->singleton(Manager::class, function() {
            return new Manager();
        });

        $this->app->singleton(TenantObserver::class, function() {
            // pass in the current tenant (company)
            return new TenantObserver(app(Manager::class)->getTenant());
        });

        Request::macro('tenant', function() {
            return app(Manager::class)->getTenant();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
