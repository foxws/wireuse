<?php

namespace Foxws\WireUse\Forms\Concerns;

use Illuminate\Database\Eloquent\Model;

trait WithModel
{
    public ?Model $model = null;

    protected static function modelClass(): ?string
    {
        return null;
    }
}
