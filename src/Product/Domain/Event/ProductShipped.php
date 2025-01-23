<?php

namespace EventBasket\Product\Domain\Event;

use Carbon\Carbon;
use DateTimeInterface;
use EventBasket\EventSourcing\Event;

readonly class ProductShipped implements Event
{
    public function __construct(
        public string $productId,
        public int    $quantity,
        public Carbon $date,
    )
    {

    }


    public function toArray(): array
    {
        return [
            'product_id' => $this->productId,
            'quantity' => $this->quantity,
            'date' => $this->date->format(DateTimeInterface::ATOM),
        ];
    }

    public static function from(array $payload): self
    {
        assert(array_key_exists('product_id', $payload) && is_string($payload['product_id']));
        assert(array_key_exists('quantity', $payload) && is_int($payload['quantity']));
        assert(array_key_exists('date', $payload) && is_string($payload['date']));

        return new self($payload['product_id'], $payload['quantity'], Carbon::createFromFormat(DateTimeInterface::ATOM, $payload['date']));
    }
}
