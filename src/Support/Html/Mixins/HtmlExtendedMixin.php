<?php

namespace Foxws\WireUse\Support\Html\Mixins;

use Livewire\Form;
use Spatie\Html\Elements\Div;

class HtmlExtendedMixin
{
    protected ?Form $form = null;

    public function wireForm(): mixed
    {
        return function (?Form $value = null): static {
            $this->form = $value;

            return $this;
        };
    }

    public function icon(): mixed
    {
        return function (string $name, ?string $class = null, ?array $attributes = []): Div {
            /** @var Div $this */

            return $this->div(svg($name, $class, $attributes));
        };
    }
}
