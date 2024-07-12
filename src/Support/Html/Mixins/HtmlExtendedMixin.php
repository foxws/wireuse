<?php

namespace Foxws\WireUse\Support\Html\Mixins;

use Foxws\WireUse\Support\Html\Elements\Icon;
use Foxws\WireUse\Support\Html\Elements\Validate;
use Livewire\Form as Livewire;
use Spatie\Html\Elements\Form;

class HtmlExtendedMixin
{
    protected ?Livewire $form = null;

    public function wireForm(): mixed
    {
        return function (Livewire $form, ?string $action = null) {
            $this->form = $form;

            return Form::create()
                ->attributeIf($action, 'wire:submit', $action);
        };
    }

    public function closeWireForm(): mixed
    {
        return function () {
            $this->form = null;

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
        return function (string $field, ?string $message = null) {
            $messageBag = $this->form?->getErrorBag();

            $hasMessage = $messageBag?->has($field);

            return Validate::create()
                ->classUnless($hasMessage, 'hidden')
                ->classIfNotNull($hasMessage, 'block py-1 text-sm')
                ->messageIf($hasMessage, $message ?? $messageBag->first($field));
        };
    }
}
