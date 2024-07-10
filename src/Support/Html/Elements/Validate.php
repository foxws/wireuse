<?php

namespace Foxws\WireUse\Support\Html\Elements;

use Spatie\Html\BaseElement;
use Spatie\Html\Elements\Span;

class Validate extends BaseElement
{
    protected $tag = 'div';

    public function message(?string $message = null): static
    {
        return $this
            ->addChildIfNotNull($message, Span::create()
                ->class('text-error-500')
                ->text($message)
            );
    }
}
