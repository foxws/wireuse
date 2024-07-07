<?php

namespace Foxws\WireUse\Support\Html;

use Foxws\WireUse\Support\Html\Elements\Form as FormElement;
use Livewire\Form;
use Spatie\Html\Html;

class HtmlExtended extends Html
{
    protected ?Form $form = null;

    public function wireForm(Form $value, ?string $action = null): FormElement
    {
        $this->form = $value;

        $form = FormElement::create();

        return $form
            ->wireSubmit($action);
    }
}
