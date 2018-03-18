<?php

namespace App\Tenant\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{
	protected $tenant;

	public function __construct(Model $tenant)
	{
	    $this->tenant = $tenant;
	}

	public function apply(Builder $builder, Model $model)
	{
		// $this->tenant->getForeignKey() is company_id
		// not hardcoded company_id incase it changes in the future
		return $builder->where($this->tenant->getForeignKey(), '=', $this->tenant->id);
	}
}