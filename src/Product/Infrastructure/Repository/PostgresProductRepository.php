<?php

namespace EventBasket\Product\Infrastructure\Repository;

use Carbon\Carbon;
use EventBasket\Product\Domain\Product;
use EventBasket\Product\Domain\Repository\ProductRepository;
use EventBasket\Product\Infrastructure\Exception\ProductNotFound;
use Illuminate\Database\DatabaseManager;
use Ramsey\Uuid\UuidInterface;

class PostgresProductRepository implements ProductRepository
{
    public function __construct(private DatabaseManager $db)
    {
    }

    public function get(UuidInterface $productId): Product
    {
        $sql = <<<SQL
            SELECT *
            FROM event_stream
            WHERE aggregate_id = :aggregate_id
            AND aggregate_type = :aggregate_type
        SQL;

        $events = $this->db->select($sql, ['aggregate_id' => $productId->toString(), 'aggregate_type' => Product::class]);

        if (count($events) === 0) {
            throw ProductNotFound::for($productId);
        }

        $product = new Product();
        foreach ($events as $rawEvent) {
            $data = json_decode($rawEvent->event_data, true);
            $event = $rawEvent->event_name::from($data);
            $product->applyEvent($event);
        }

        return $product;
    }

    public function exists(string $name): bool
    {
        // @todo To find out if a product exists with a name we will need a projection
//        try {
//            $this->get($productId);
//        } catch (ProductNotFound) {
//            return false;
//        }
//
//        return true;
        return false;
    }

    public function save(Product $product): void
    {
        $events = $product->events();

        foreach ($events as $event) {
            $this->db->table('event_stream')->insert([
                'aggregate_id' => $product->productId,
                'aggregate_type' => get_class($product),
                'event_name' => get_class($event),
                'event_data' => json_encode($event->toArray()),
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
