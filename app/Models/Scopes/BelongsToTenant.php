<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class BelongsToTenant implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        // Only apply if tenant is set in session
        if ($tenantId = session('tenant_id')) {
            $builder->where($model->getTable() . '.tenant_id', $tenantId);
        }
    }
}
