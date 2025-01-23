<?php

namespace EventBasket\EventSourcing;
interface Event
{
    public function toArray(): array;

    public static function from(array $payload): self;
}
