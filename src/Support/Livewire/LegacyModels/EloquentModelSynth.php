<?php

namespace Foxws\WireUse\Support\Livewire\LegacyModels;

use Illuminate\Database\ClassMorphViolationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Livewire\Features\SupportLegacyModels\EloquentModelSynth as Synth;

class EloquentModelSynth extends Synth
{
    public function dehydrate($target, $dehydrateChild)
    {
        $class = $target::class;

        try {
            // If no alias is found, this just returns the class name
            $alias = $target->getMorphClass();
        } catch (ClassMorphViolationException $e) {
            // If the model is not using morph classes, this exception is thrown
            $alias = $class;
        }

        $meta = [];

        if ($target->exists) {
            $meta['key'] = $target->getRouteKey();
        }

        $meta['class'] = $alias;

        if ($target->getConnectionName() !== $class::make()->getConnectionName()) {
            $meta['connection'] = $target->getConnectionName();
        }

        $relations = $target->getQueueableRelations();

        if (count($relations)) {
            $meta['relations'] = $relations;
        }

        $rules = $this->getRules($this->context);

        if (empty($rules)) {
            return [[], $meta];
        }

        $data = $this->getDataFromModel($target, $rules);

        foreach ($data as $key => $child) {
            $data[$key] = $dehydrateChild($key, $child);
        }

        return [$data, $meta];
    }

    protected function loadModel($meta): ?Model
    {
        $class = $meta['class'];

        // If no alias found, this returns `null`
        $aliasClass = Relation::getMorphedModel($class);

        if (! is_null($aliasClass)) {
            $class = $aliasClass;
        }

        if (isset($meta['key'])) {
            $model = new $class;

            if (isset($meta['connection'])) {
                $model->setConnection($meta['connection']);
            }

            $query = $model
                ->newQueryWithoutScopes()
                ->where((new $class)->getRouteKeyName(), $meta['key']);

            if (isset($meta['relations'])) {
                $query->with($meta['relations']);
            }

            $model = $query->first();
        } else {
            $model = new $class();
        }

        return $model;
    }
}
