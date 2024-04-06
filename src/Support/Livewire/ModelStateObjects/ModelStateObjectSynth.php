<?php

namespace Foxws\WireUse\Support\Livewire\ModelStateObjects;

use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;
use Spatie\ModelStates\State;

class ModelStateObjectSynth extends Synth
{
    public static $key = 'mstt';

    public static function match($target)
    {
        return $target instanceof State;
    }

    public function dehydrate($target)
    {
        return [$target->getMorphClass(), []];
    }

    public function hydrate($value)
    {
        return $value;
    }
}
