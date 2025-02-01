<?php

namespace EventBasket\EventSource\Projection\Repository;

use EventBasket\EventSource\Projection\Entity\Projector;
use EventBasket\EventSource\Projection\Entity\ProjectorCollection;
use EventBasket\EventSource\Projection\ProjectorMode;
use EventBasket\EventSource\Projection\ProjectorRepositoryInterface;
use EventBasket\EventSource\Projection\ProjectorState;
use Illuminate\Database\Connection;

class PostgresProjectorRepository implements ProjectorRepositoryInterface
{
    public function __construct(private readonly Connection $db)
    {

    }

    public function findActive(): ProjectorCollection
    {
        $query = <<<SQL
        SELECT id, name, state, mode
        FROM projectors
        WHERE state IN (:states)
SQL;

        $projectors = $this->db->select($query, [
            'states' => implode(',', [
                ProjectorState::Booted->name,
                ProjectorState::Playing->name,
            ])
        ]);

        dd($projectors);
    }

    public function findNew(): ProjectorCollection
    {
        $query = <<<SQL
        SELECT id, name, state, mode
        FROM projectors
        WHERE state = :new
SQL;

        $data = $this->db->select($query, ['new' => ProjectorState::New->value]);

        $projectors = new ProjectorCollection();

        foreach ($data as $projector) {
            dump('Making instance of ' . $projector->name . '...');
            $projectors[] = new ($projector->name)(
                $projector->id,
                ProjectorState::from($projector->state),
                ProjectorMode::from($projector->mode,
                ));
        }

        return $projectors;
    }

    public function update(Projector $projector): void
    {
        dump('Updating projector ' . $projector->id . ' with state ' . $projector->state->value);
        $query = <<<SQL
        UPDATE projectors
        SET state = :state
        WHERE id = :id
SQL;

        $this->db->update($query, [
            'id' => $projector->id,
            'state' => $projector->state->value,
        ]);
    }


}
