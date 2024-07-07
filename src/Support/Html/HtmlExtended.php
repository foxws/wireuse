<?php

namespace Foxws\WireUse\Support\Html;

use Livewire\Form;
use Spatie\Html\Elements\Div;
use Spatie\Html\Html;

class HtmlExtended extends Html
{
    protected ?Form $form = null;

    public function wireForm(Form $value): static
    {
        $this->form = $value;

        return $this;
    }

    public function icon(string $name, ?string $class = null, ?array $attributes = []): Div
    {
        return $this->div(svg($name, $class, $attributes));
    }
}
