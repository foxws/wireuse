<?php

namespace Foxws\WireUse\Support\Livewire\ActionObjects;

use Foxws\WireUse\Actions\Support\Action;
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
        $action = new Action($value['container'], $value['name']);

        $action->attributes($this->getAttributes($value));

        return $action;
    }

    protected function getAttributes(array $values): array
    {
        return collect($values)
            ->except('container', 'name')
            ->toArray();
    }
}
