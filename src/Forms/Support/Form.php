<?php

namespace Foxws\WireUse\Forms\Support;

use Foxws\WireUse\Auth\Concerns\WithAuthorization;
use Foxws\WireUse\Exceptions\RateLimitedException;
use Foxws\WireUse\Forms\Concerns\WithForm;
use Foxws\WireUse\Forms\Concerns\WithSession;
use Foxws\WireUse\Forms\Concerns\WithThrottle;
use Foxws\WireUse\Forms\Concerns\WithValidation;
use Foxws\WireUse\Support\Concerns\Hookable;
use Livewire\Form as BaseForm;

abstract class Form extends BaseForm
{
    use WithAuthorization;
    use WithForm;
    use Hookable;
    use WithSession;
    use WithThrottle;
    use WithValidation;

    public function submit(): void
    {
        try {
            $this->rateLimit();

            $this->callHook('beforeValidate');

            $this->check();

            $this->callHook('afterValidate');

            $this->store();

            $this->callHook('beforeHandle');

            $this->handle();

            $this->callHook('afterHandle');
        } catch (RateLimitedException $e) {
            $this->handleThrottle($e);
        }
    }

    protected function handle(): void
    {
        //
    }
}
