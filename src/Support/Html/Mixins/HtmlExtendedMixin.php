<?php

namespace Foxws\WireUse\Support\Html\Mixins;

use Foxws\WireUse\Support\Html\Elements\Icon;
use Livewire\Form;

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

    public function icon()
    {
        return function (): Icon {
            return Icon::create();
        };
    }
}
