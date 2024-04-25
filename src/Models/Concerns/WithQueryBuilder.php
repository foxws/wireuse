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
    protected static ?int $limit = 16;

    public function bootWithQueryBuilder(): void
    {
        throw_if(! is_subclass_of($this->getModelClass(), Model::class));

        $this->authorize('viewAny', $this->getModelClass());
    }

    protected static function getModelClass(): ?string
    {
        return static::$model;
    }

    protected static function getModel(): Model
    {
        return app(static::getModelClass());
    }

    protected static function getQuery(): Builder
    {
        return static::getModel()->newQuery();
    }

    protected static function getScout(string $query = '*', ?Closure $callback = null): ScoutBuilder
    {
        return static::getModel()->search($query, $callback);
    }

    protected static function getLimit(): ?int
    {
        return static::$limit;
    }
}
