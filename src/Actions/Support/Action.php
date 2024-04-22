<?php

namespace Foxws\WireUse\Actions\Support;

use Closure;
use Foxws\WireUse\Actions\Concerns\HasIcon;
use Foxws\WireUse\Actions\Concerns\HasName;
use Foxws\WireUse\Actions\Concerns\HasRequest;
use Foxws\WireUse\Actions\Concerns\HasRoute;
use Foxws\WireUse\Support\Components\Component;

class Action extends Component
{
    use HasIcon;
    use HasName;
    use HasRequest;
    use HasRoute;

    public static function make(string | Closure | null $name = null): static
    {
        $static = app(static::class, ['name' => $name]);

        return $static;
    }
}
