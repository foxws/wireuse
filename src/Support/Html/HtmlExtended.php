<?php

namespace Foxws\WireUse\Support\Html;

use Illuminate\Support\HtmlString;
use Livewire\Form;
use Spatie\Html\Attributes;
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

    public function icon(string $name)
    {
        return $this->div(svg($name, 'fill-white size-5 text-white'));

        // return $this
        //     ->element('svg')
        //     ->attribute('name', $name)
        //     ->toHtml();
    }
}
