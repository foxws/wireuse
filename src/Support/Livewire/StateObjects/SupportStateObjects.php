<?php

namespace Foxws\WireUse\Support\Livewire\StateObjects;

use Livewire\ComponentHook;
use ReflectionClass;
use ReflectionNamedType;

class SupportStateObjects extends ComponentHook
{
    public static function provide()
    {
        app('livewire')->propertySynthesizer(
            StateObjectSynth::class
        );
    }

    public function boot()
    {
        $this->initializeStateObjects();
    }

    protected function initializeStateObjects()
    {
        foreach ((new ReflectionClass($this->component))->getProperties() as $property) {
            // Public properties only...
            if ($property->isPublic() !== true) {
                continue;
            }

            // Uninitialized properties only...
            if ($property->isInitialized($this->component)) {
                continue;
            }

            $type = $property->getType();

            if (! $type instanceof ReflectionNamedType) {
                continue;
            }

            $typeName = $type->getName();

            // "State" object property types only...
            if (! is_subclass_of($typeName, State::class)) {
                continue;
            }

            $state = new $typeName(
                $this->component,
                $name = $property->getName()
            );

            $callBootMethod = StateObjectSynth::bootStateObject($this->component, $state, $name);

            $property->setValue($this->component, $state);

            $callBootMethod();
        }
    }
}
