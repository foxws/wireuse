<?php

namespace Foxws\WireUse\Support\Html\Elements;

use Spatie\Html\BaseElement;

class Icon extends BaseElement
{
    protected $tag = 'span';

    public function svg(?string $name = null, ?string $class = null, ?array $attributes = []): static
    {
        throw_if(! function_exists('svg'), 'Make sure blade-ui-kit/blade-icons is installed');

        return $this->html(svg($name, $class, $attributes)->toHtml());
    }
}
