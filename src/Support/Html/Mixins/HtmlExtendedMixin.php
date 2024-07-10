<?php

namespace Foxws\WireUse\Support\Html\Mixins;

use Foxws\WireUse\Support\Html\Elements\Icon;
use Foxws\WireUse\Support\Html\Elements\Validate;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Validation\ValidationException;
use Livewire\Form as Livewire;
use Spatie\Html\Elements\Form;

class HtmlExtendedMixin
{
    protected ?Livewire $form = null;

    public function wireForm(): mixed
    {
        return function (?Livewire $form = null, ?string $action = null): Form {
            $this->form = $form;

            try {
                $this->form->validate();
            } catch (ValidationException $e) {

            }

            $element = Form::create();

            return $element
                ->attributeIf($action, 'wire:submit', $action);
        };
    }

    public function closeWireForm(): Htmlable
    {
        $this->form = null;

        $element = Form::create();

        return $element->close();
    }

    public function icon()
    {
        return function (): Icon {
            return Icon::create();
        };
    }

    public function validate()
    {
        return function (?string $field = null): Validate {
            $element = Validate::create();

            $errorBag = $this->form?->getErrorBag();

            if ($errorBag && ($message = $errorBag->first($field))) {
                return $element->message($message);
            }

            return $element;
        };
    }
}
