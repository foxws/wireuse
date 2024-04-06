<?php

namespace Foxws\WireUse\Support\Livewire\LegacyModels;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Livewire\Features\SupportLegacyModels\EloquentCollectionSynth as Synth;

class EloquentCollectionSynth extends Synth
{
    public function dehydrate(EloquentCollection $target, $dehydrateChild)
    {
        $class = $target::class;

        $modelClass = $target->getQueueableClass();
        $modelKeys = array_map(fn ($model) => $model->getRouteKey(), $target->all());

        $meta = [];

        $meta['keys'] = $modelKeys;
        $meta['class'] = $class;
        $meta['modelClass'] = $modelClass;

        if ($modelClass && ($connection = $this->getConnection($target)) !== $modelClass::make()->getConnectionName()) {
            $meta['connection'] = $connection;
        }

        $relations = $target->getQueueableRelations();

        if (count($relations)) {
            $meta['relations'] = $relations;
        }

        $rules = $this->getRules($this->context);

        if (empty($rules)) {
            return [[], $meta];
        }

        $data = $this->getDataFromCollection($target, $rules);

        foreach ($data as $key => $child) {

            $data[$key] = $dehydrateChild($key, $child);
        }

        return [$data, $meta];
    }

    protected function loadCollection($meta)
    {
        if (isset($meta['keys']) && count($meta['keys']) >= 0 && ! empty($meta['modelClass'])) {
            $model = new $meta['modelClass'];

            if (isset($meta['connection'])) {
                $model->setConnection($meta['connection']);
            }

            $query = $model
                ->newQueryWithoutScopes()
                ->whereIn((new $meta['modelClass'])->getRouteKeyName(), $meta['keys']);

            if (isset($meta['relations'])) {
                $query->with($meta['relations']);
            }

            $query->useWritePdo();

            $collection = $query->get();

            $collection = $collection->keyBy->getRouteKey();

            return new $meta['class'](
                collect($meta['keys'])->map(function ($id) use ($collection) {
                    return $collection[$id] ?? null;
                })->filter()
            );
        }

        return new $meta['class']();
    }
}
