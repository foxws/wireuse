<?php

namespace Foxws\WireUse\Support\Html\Elements;

use Spatie\Html\Elements\Form as FormElement;

class Form extends FormElement
{
    public function wireSubmit(?string $action = null): static
    {
        $this->attributeIfNotNull($action, 'wire:submit', $action);

        return $this;
    }
}
