<?php

use EventBasket\EventSource\Projection\ProjectorMode;
use EventBasket\EventSource\Projection\ProjectorState;
use EventBasket\Product\Infrastructure\Projector\ProductListProjector;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $sql = <<<SQL
        INSERT INTO projectors (name, state, mode, created_at, updated_at)
        VALUES (:name, :state, :mode, NOW(), NOW());

SQL;

        DB::insert($sql, [
            'name' => ProductListProjector::class,
            'state' => ProjectorState::New->value,
            'mode' => ProjectorMode::RunFromBeginning->value,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::delete("DELETE FROM projectors WHERE name = :name", ['name' => ProductListProjector::class]);
    }
};
