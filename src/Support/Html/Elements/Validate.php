<?php

namespace Foxws\WireUse\Support\Html\Elements;

use Spatie\Html\BaseElement;

class Validate extends BaseElement
{
    protected $tag = 'div';

    public function message(?string $message = null): static
    {
        return $this;

        // return $this->html("@error('{$name}') {{ $message }} @enderror");
    }
}
