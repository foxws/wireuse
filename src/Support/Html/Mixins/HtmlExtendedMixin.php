<?php

namespace Foxws\WireUse\Support\Html\Mixins;

use Foxws\WireUse\Support\Html\Elements\Icon;
use Foxws\WireUse\Support\Html\Elements\Validate;
use Livewire\Form as Livewire;
use Spatie\Html\Elements\Form;
use stdClass;

#[\AllowDynamicProperties]
class HtmlExtendedMixin extends stdClass
{
    protected ?Livewire $form = null;

    public function wireForm(): mixed
    {
        return function (Livewire $form, ?string $action = null): Form {
            $this->form = $form;

            return Form::create()
                ->attributeIf($action, 'wire:submit', $action);
        };
    }

    public function closeWireForm(): mixed
    {
        return function (): Form {
            $this->form = null;

            return Form::create()->close();
        };
    }

    public function error(): mixed
    {
        return function (string $field, ?string $message = null, ?string $format = null): Validate {
            $messageBag = $this->form?->getComponent()->getErrorBag();

            $hasMessage = $messageBag?->has($field) ?? false;

            return Validate::create()
                ->classUnless($hasMessage, 'hidden')
                ->classIf($hasMessage, 'label')
                ->messageIf($hasMessage, $message ?: $messageBag?->first($field, $format));
        };
    }

    public function icon(): mixed
    {
        return function (): Icon {
            return Icon::create();
        };
    }
}
