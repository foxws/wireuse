<?php

namespace Foxws\WireUse\Support\Html\Mixins;

use Foxws\WireUse\Support\Html\Elements\Icon;
use Foxws\WireUse\Support\Html\Elements\Validate;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\ValidationException;
use Livewire\Form as Livewire;
use Spatie\Html\Elements\Form;

class HtmlExtendedMixin
{
    protected ?Livewire $form = null;

    protected ?MessageBag $messages = null;

    public function wireForm(): mixed
    {
        return function (Livewire $form, ?string $action = null): Form {
            $this->form = $form;

            $this->messages = null;

            try {
                $this->form->validate();
            } catch (ValidationException $e) {
                $this->messages = $e->validator->getMessageBag();
            }

            return Form::create()
                ->attributeIf($action, 'wire:submit', $action);
        };
    }

    public function closeWireForm(): Htmlable
    {
        $this->form = null;

        $this->messages = null;

        return Form::create()->close();
    }

    public function icon()
    {
        return function (): Icon {
            return Icon::create();
        };
    }

    public function validate()
    {
        return function (string $field, ?string $message = null): Validate {
            $message ??= $this->messages?->first($field);

            return Validate::create()
                ->classUnless($message, 'hidden')
                ->classIfNotNull($message, 'block py-1 text-sm')
                ->messageIf($this->messages?->has($field), $message);
        };
    }
}
