<?php

namespace App\Support;

class NotificationFailureContext
{
    private ?array $context = null;

    public function set(array $context): void
    {
        $this->context = $context;
    }

    public function current(): ?array
    {
        return $this->context;
    }

    public function clear(): void
    {
        $this->context = null;
    }
}
