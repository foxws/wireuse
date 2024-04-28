<?php

namespace Foxws\WireUse\Forms\Support;

abstract class CreateForm extends Form
{
    protected function handle(): void
    {
        //
    }

    protected function beforeValidate(): void
    {
        $this->canCreate(static::modelClass());
    }

    protected static function modelClass(): ?string
    {
        return null;
    }
}
