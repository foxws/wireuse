<?php

namespace Foxws\WireUse\Support\Livewire\Models;

use Illuminate\Database\Eloquent\Relations\Relation;
use Livewire\Features\SupportModels\EloquentCollectionSynth as Synth;

class CollectionSynth extends Synth
{
    public function hydrate($data, $meta, $hydrateChild)
    {
        $class = $meta['class'];

        $modelClass = $meta['modelClass'];

        // If no alias found, this returns `null`
        $modelAlias = Relation::getMorphedModel($modelClass);

        if (! is_null($modelAlias)) {
            $modelClass = $modelAlias;
        }

        $keys = $meta['keys'] ?? [];

        if (count($keys) === 0) {
            return new $class();
        }

        // We are using Laravel's method here for restoring the collection, which ensures
        // that all models in the collection are restored in one query, preventing n+1
        // issues and also only restores models that exist.
        $collection = (new $modelClass)
            ->newQueryWithoutScopes()
            ->whereIn((new $modelClass)->getRouteKeyName(), $keys)
            ->useWritePdo()
            ->get();

        $collection = $collection->keyBy->getRouteKey();

        return new $meta['class'](
            collect($meta['keys'])->map(function ($id) use ($collection) {
                return $collection[$id] ?? null;
            })->filter()
        );
    }
}
