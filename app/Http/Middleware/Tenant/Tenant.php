<?php

namespace App\Http\Middleware\Tenant;

use App\Company;
use App\Tenant\Manager;
use Closure;
use Illuminate\Support\Facades\Auth;

class Tenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $tenant = $this->resolveTenant(
            $request->company ?: session()->get('tenant')
        );

        if(!Auth::user()->companies->contains('id', $tenant->id)) {
            return redirect('/home');
        }

        $this->registerTenant($tenant);

        return $next($request);
    }

    protected function registerTenant($tenant)
    {
         app(Manager::class)->setTenant($tenant);

        // Add tenant id to session
        session()->put('tenant', $tenant->id);
    }

    protected function resolveTenant($id)
    {
        return Company::find($id);
    }
}
