<?php

namespace Foxws\WireUse\Support\Html;

use Livewire\Form;
use Spatie\Html\Elements\Element;
use Spatie\Html\Html;

class HtmlExtended extends Html
{
    protected ?Form $form = null;

    public function wireForm(Form $value): static
    {
        $this->form = $value;

        return $this;
    }

    public function icon(string $name): Element
    {
        return $this
            ->element('x-icon')
            ->attribute('name', $name);
    }
}
