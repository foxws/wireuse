<?php

namespace Foxws\WireUse\Exceptions;

use Exception;

class RateLimitedException extends Exception
{
    public function __construct(
        public string $ip,
        public int $seconds,
    ) {
        parent::__construct(sprintf(
            'Too many requests from [%s]. Retry in %d seconds.',
            $this->ip,
            $this->seconds,
        ));
    }
}
