<?php

namespace EventBasket\EventSource\Projection;

/**
 * The projectionist is a projector manager.
 * It knows about projector states, and the fact during booting the application projectors need to
 * be booted, which might require going over the event store.
 */
interface ProjectionistInterface
{
    public function boot(): void;

    public function play(): void;
}
