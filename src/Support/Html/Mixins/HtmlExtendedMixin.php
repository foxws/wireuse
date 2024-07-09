<?php

namespace Foxws\WireUse\Support\Html\Mixins;

use Foxws\WireUse\Support\Html\Elements\Icon;
use Livewire\Form as Livewire;
use Spatie\Html\Elements\Form;

class HtmlExtendedMixin
{
    protected ?Livewire $form = null;

    public function wireForm(): mixed
    {
        return function (?Livewire $value = null, ?string $action = null): Form {
            $this->form = $value;

            $form = Form::create();

            return $form
                ->attributeIf($action, 'wire:submit', $action);
        };
    }

    public function icon()
    {
        return function (): Icon {
            return Icon::create();
        };
    }
}
