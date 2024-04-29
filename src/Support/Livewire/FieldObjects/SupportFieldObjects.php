<?php

namespace Foxws\WireUse\Support\Livewire\FieldObjects;

use Livewire\ComponentHook;

class SupportFieldObjects extends ComponentHook
{
    public static function provide()
    {
        app('livewire')->propertySynthesizer(
            FieldObjectSynth::class
        );
    }
}
