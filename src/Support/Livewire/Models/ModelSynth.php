<?php

namespace Foxws\WireUse\Support\Livewire\Models;

use Illuminate\Database\ClassMorphViolationException;
use Illuminate\Database\Eloquent\Relations\Relation;
use Livewire\Features\SupportModels\ModelSynth as Synth;

class ModelSynth extends Synth
{
    public function dehydrate($target)
    {
        $class = $target::class;

        try {
            // If no alias is found, this just returns the class name
            $alias = $target->getMorphClass();
        } catch (ClassMorphViolationException $e) {
            // If the model is not using morph classes, this exception is thrown
            $alias = $class;
        }

        $serializedModel = $target->exists
            ? (array) $this->getSerializedPropertyValue($target)
            : null;

        $meta = ['class' => $alias];

        // If the model doesn't exist as it's an empty model or has been
        // recently deleted, then we don't want to include any key.
        if ($serializedModel) {
            $meta['key'] = $target->getRouteKey();
        }

        return [
            null,
            $meta,
        ];
    }

    public function hydrate($data, $meta)
    {
        $class = $meta['class'];

        // If no alias found, this returns `null`
        $aliasClass = Relation::getMorphedModel($class);

        if (! is_null($aliasClass)) {
            $class = $aliasClass;
        }

        // If no key is provided then an empty model is returned
        if (! array_key_exists('key', $meta)) {
            return new $class;
        }

        $key = $meta['key'];

        $model = (new $class)
            ->newQueryWithoutScopes()
            ->where((new $class)->getRouteKeyName(), $key)
            ->useWritePdo()
            ->firstOrFail();

        return $model;
    }
}
