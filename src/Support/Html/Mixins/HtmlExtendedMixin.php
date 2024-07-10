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
        return function (?string $field = null, ?string $message = null): Validate {
            try {
                $this->form?->validate();
            } catch (ValidationException $e) {
                $message ??= $e->validator->errors()->first($field);
            }

            return Validate::create()
                ->classUnless($message, 'hidden')
                ->classIfNotNull($message, 'block py-1 text-sm')
                ->error($message);
        };
    }
}
