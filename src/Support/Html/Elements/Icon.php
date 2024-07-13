<?php

namespace Foxws\WireUse\Support\Html\Elements;

use Spatie\Html\BaseElement;

class Icon extends BaseElement
{
    protected $tag = 'span';

    public function svg(?string $name = null, ?string $class = null, ?array $attributes = []): static
    {
        return $this->html(svg($name, $class, $attributes)->toHtml());
    }
}
