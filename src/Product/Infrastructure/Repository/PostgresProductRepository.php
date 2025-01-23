<?php

namespace EventBasket\Product\Infrastructure\Repository;

use Carbon\Carbon;
use EventBasket\Product\Domain\Product;
use EventBasket\Product\Domain\Repository\ProductRepository;
use EventBasket\Product\Infrastructure\Exception\ProductNotFound;
use Illuminate\Database\DatabaseManager;

class PostgresProductRepository implements ProductRepository
{
    public function __construct(private DatabaseManager $db)
    {
    }

    public function get(string $productId): Product
    {
        $sql = <<<SQL
            SELECT *
            FROM event_stream
            WHERE aggregate_id = :aggregate_id
            AND aggregate_type = :aggregate_type
        SQL;

        $events = $this->db->select($sql, ['aggregate_id' => $productId, 'aggregate_type' => Product::class]);

        if(count($events) === 0)
        {
            throw ProductNotFound::for($productId);
        }

        $product = new Product($productId);
        foreach($events as $rawEvent)
        {
            $data = json_decode($rawEvent->event_data, true);
            $event = $rawEvent->event_name::from($data);
            $product->applyEvent($event);
        }

        // @todo what happens when product does not exist
        return $product;
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
