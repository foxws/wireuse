<?php

namespace Foxws\WireUse\Support\Html\Elements;

use Spatie\Html\BaseElement;
use Spatie\Html\Elements\Span;

class Validate extends BaseElement
{
    protected $tag = 'div';

    public function message(?string $message = null): static
    {
        $element = Span::create();

        return $this
            ->addChild($element->class('label-error')->text($message));
    }
}
