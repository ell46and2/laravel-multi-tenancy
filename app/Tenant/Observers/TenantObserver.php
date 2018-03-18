<?php

namespace App\Tenant\Observers;

use Illuminate\Database\Eloquent\Model;

class TenantObserver
{
	protected $tenant;

	public function __construct(Model $tenant)
	{
	    $this->tenant = $tenant;
	}

	public function creating(Model $model)
	{
		$foreignKey = $this->tenant->getForeignKey();

		if(!isset($model->{$foreignKey})) {
			$model->setAttribute($foreignKey, $this->tenant->id);
		}
	}

}