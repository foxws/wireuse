<?php

namespace Foxws\WireUse\Support\Livewire\ModelStateObjects;

use Livewire\ComponentHook;

class SupportModelStateObjects extends ComponentHook
{
    public static function provide()
    {
        app('livewire')->propertySynthesizer(
            ModelStateObjectSynth::class
        );
    }
}
