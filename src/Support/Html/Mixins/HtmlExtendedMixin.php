<?php

namespace Foxws\WireUse\Support\Html\Mixins;

use Foxws\WireUse\Support\Html\Elements\Icon;
use Foxws\WireUse\Support\Html\Elements\Validate;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\ValidationException;
use Livewire\Form as Livewire;
use Spatie\Html\Elements\Form;

class HtmlExtendedMixin
{
    protected ?Livewire $form = null;

    protected ?MessageBag $errorBag = null;

    public function wireForm(): mixed
    {
        return function (Livewire $form, ?string $action = null): Form {
            $this->form = $form;

            $this->errorBag = null;

            try {
                $this->form->validate();
            } catch (ValidationException $e) {
                $this->errorBag = $e->validator->errors();
            }

            return Form::create()
                ->attributeIf($action, 'wire:submit', $action);
        };
    }

    public function closeWireForm(): mixed
    {
        return function (): Form {
            $this->form = null;

            $this->errorBag = null;

            return Form::create()->close();
        };
    }

    public function icon(): mixed
    {
        return function (): Icon {
            return Icon::create();
        };
    }

    public function validate(): mixed
    {
        return function (string $field, ?string $message = null): Validate {
            $hasMessage = $this->errorBag?->has($field);

            $message ??= $this->errorBag?->first($field);

            return Validate::create()
                ->classUnless($hasMessage, 'hidden')
                ->classIfNotNull($hasMessage, 'block py-1 text-sm')
                ->messageIf($hasMessage, $message);
        };
    }
}
