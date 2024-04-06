<?php

namespace Foxws\WireUse\Support\Livewire\StateObjects;

use Livewire\Drawer\Utils;
use Livewire\Features\SupportAttributes\AttributeCollection;
use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;

use function Livewire\wrap;

class StateObjectSynth extends Synth
{
    public static $key = 'stt';

    public static function match($target)
    {
        return $target instanceof State;
    }

    public function dehydrate($target, $dehydrateChild)
    {
        $data = $target->toArray();

        foreach ($data as $key => $child) {
            $data[$key] = $dehydrateChild($key, $child);
        }

        return [$data, ['class' => get_class($target)]];
    }

    public function hydrate($data, $meta, $hydrateChild)
    {
        $state = new $meta['class']($this->context->component, $this->path);

        $callBootMethod = static::bootStateObject($this->context->component, $state, $this->path);

        foreach ($data as $key => $child) {
            if ($child === null && Utils::propertyIsTypedAndUninitialized($state, $key)) {
                continue;
            }

            $state->$key = $hydrateChild($key, $child);
        }

        $callBootMethod();

        return $state;
    }

    public function set(&$target, $key, $value)
    {
        if ($value === null && Utils::propertyIsTyped($target, $key)) {
            unset($target->$key);
        } else {
            $target->$key = $value;
        }
    }

    public static function bootStateObject($component, $state, $path)
    {
        $component->mergeOutsideAttributes(
            AttributeCollection::fromComponent($component, $state, $path.'.')
        );

        return function () use ($state) {
            wrap($state)->boot();
        };
    }
}
