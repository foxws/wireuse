<?php

namespace Foxws\WireUse\Exceptions;

use Exception;

class RateLimitedException extends Exception
{
    public function __construct(
        public ?string $ip = null,
        public ?int $seconds = null,
    ) {
        parent::__construct(sprintf(
            'Too many requests from [%s]. Retry in %d seconds.',
            $this->ip,
            $this->seconds,
        ));
    }
}
