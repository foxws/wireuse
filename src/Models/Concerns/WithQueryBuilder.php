<?php

namespace Foxws\WireUse\Models\Concerns;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Builder as ScoutBuilder;

/**
 * @property ?string $model
 */
trait WithQueryBuilder
{
    public function bootWithQueryBuilder(): void
    {
        throw_unless(is_subclass_of($this->getModelClass(), Model::class));

        $this->authorize('viewAny', $this->getModelClass());
    }

    protected function getModelClass(): ?string
    {
        return static::$model;
    }

    protected function getModel(): Model
    {
        return app($this->getModelClass());
    }

    protected function getQuery(): Builder
    {
        return $this->getModel()->newQuery();
    }

    protected function getScout(string $query = '*', ?Closure $callback = null): ScoutBuilder
    {
        return $this->getModel()->search($query, $callback);
    }
}
