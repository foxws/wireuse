<?php

namespace Foxws\WireUse\Forms\Concerns;

use Livewire\Form;

trait WithForms
{
    protected function getForm(?string $name = null): ?Form
    {
        $forms = collect($this->getFormObjects());

        return blank($name)
            ? $forms->first()
            : $forms->firstWhere('propertyName', $name);
    }
}
