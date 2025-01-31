<?php

namespace EventBasket\Product\Domain\Event;

use Carbon\Carbon;
use DateTimeInterface;
use EventBasket\EventSource\Event\EventInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

readonly class ProductReceived implements EventInterface
{
    public function __construct(
        public UuidInterface $productId,
        public int           $quantity,
        public Carbon        $date,
    )
    {

    }

    public function toArray(): array
    {
        return [
            'product_id' => $this->productId->toString(),
            'quantity' => $this->quantity,
            'date' => $this->date->format(DateTimeInterface::ATOM),
        ];
    }

    public static function from(array $payload): EventInterface
    {
        assert(array_key_exists('product_id', $payload) && is_string($payload['product_id']));
        assert(array_key_exists('quantity', $payload) && is_int($payload['quantity']));
        assert(array_key_exists('date', $payload) && is_string($payload['date']));

        return new self(
            Uuid::fromString($payload['product_id']),
            $payload['quantity'],
            Carbon::createFromFormat(DateTimeInterface::ATOM, $payload['date']),
        );
    }
}
