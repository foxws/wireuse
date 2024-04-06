<?php

namespace Foxws\WireUse\Auth\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

trait WithAuthorization
{
    use AuthorizesRequests;

    public function bootWithAuthorization(): void
    {
        $this->authorizeAccess();
    }

    protected function authorizeAccess(): void
    {
        // $this->canViewAny(Todo::class);
    }

    protected function canViewAny(mixed $arguments): void
    {
        if ($arguments instanceof Model) {
            $arguments = $arguments->getMorphClass();
        }

        $this->authorize('viewAny', $arguments);
    }

    protected function canView(mixed $arguments): void
    {
        $this->authorize('view', $arguments);
    }

    protected function canCreate(mixed $arguments): void
    {
        $this->authorize('create', $arguments);
    }

    protected function canUpdate(mixed $arguments): void
    {
        $this->authorize('update', $arguments);
    }

    protected function canDelete(mixed $arguments): void
    {
        $this->authorize('delete', $arguments);
    }
}
