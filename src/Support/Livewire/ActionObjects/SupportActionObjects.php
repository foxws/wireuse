<?php

namespace Foxws\WireUse\Support\Livewire\ActionObjects;

use Livewire\ComponentHook;

class SupportActionObjects extends ComponentHook
{
    public static function provide()
    {
        app('livewire')->propertySynthesizer(
            ActionObjectSynth::class
        );
    }
}
