<?php

namespace Foxws\WireUse\Support\Livewire\FieldObjects;

use Foxws\WireUse\Forms\Support\Field;
use Foxws\WireUse\Forms\Support\Schema;
use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;

class FieldObjectSynth extends Synth
{
    public static $key = 'fld';

    public static function match($target)
    {
        return $target instanceof Field;
    }

    public function dehydrate($target)
    {
        return [$target->toArray(), []];
    }

    public function hydrate($value)
    {
        $container = Schema::make(
            data_get($value['container'], 'name', null),
            data_get($value['container'], 'attributes', [])
        );

        $field = new Field($container, $value['name']);

        $field->attributes(
            collect($value)->except('container', 'name')->toArray()
        );

        return $field;
    }
}
