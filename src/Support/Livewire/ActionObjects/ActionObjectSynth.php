<?php

namespace Foxws\WireUse\Support\Livewire\ActionObjects;

use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Actions\Support\Actions;
use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;

class ActionObjectSynth extends Synth
{
    public static $key = 'act';

    public static function match($target)
    {
        return $target instanceof Action;
    }

    public function dehydrate($target)
    {
        return [$target->toArray(), []];
    }

    public function hydrate($value)
    {
        $container = Actions::make(
            data_get($value['container'], 'name', null),
            data_get($value['container'], 'attributes', [])
        );

        $action = new Action($container, $value['name']);

        $action->attributes(
            collect($value)->except('container', 'name')->toArray()
        );

        return $action;
    }
}
