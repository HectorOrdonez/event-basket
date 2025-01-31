<?php

namespace EventBasket\EventSource\Event;
interface EventInterface
{
    public function toArray(): array;

    public static function from(array $payload): self;
}
