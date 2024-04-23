<?php

namespace Foxws\WireUse\Actions\Support;

use Foxws\WireUse\Actions\Concerns\HasComponent;
use Foxws\WireUse\Actions\Concerns\HasIcon;
use Foxws\WireUse\Actions\Concerns\HasName;
use Foxws\WireUse\Actions\Concerns\HasRequest;
use Foxws\WireUse\Actions\Concerns\HasRoute;
use Foxws\WireUse\Actions\Concerns\HasState;
use Foxws\WireUse\Actions\Concerns\HasView;
use Foxws\WireUse\Support\Components\Component;

class Action extends Component
{
    use HasComponent;
    use HasIcon;
    use HasName;
    use HasRequest;
    use HasRoute;
    use HasState;
    use HasView;

    public static function make(): static
    {
        $static = app(static::class);

        return $static;
    }
}
