<?php

namespace EventBasket\EventSource\Projection\Repository;

use EventBasket\EventSource\Projection\Entity\Projector;
use EventBasket\EventSource\Projection\Entity\ProjectorCollection;
use EventBasket\EventSource\Projection\ProjectorMode;
use EventBasket\EventSource\Projection\ProjectorRepositoryInterface;
use EventBasket\EventSource\Projection\ProjectorState;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\DB;

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
            'states' => implode(',' , [
                ProjectorState::Booted->name,
                ProjectorState::Playing->name,
            ])
        ]);

        dd($projectors);
    }

    public function findPending(): ProjectorCollection
    {
        $query = <<<SQL
        SELECT id, name, state, mode
        FROM projectors
        WHERE state IN (:pending, :broken, :stalled)
SQL;

        $data = $this->db->select($query, [
            'pending' => ProjectorState::Pending->value,
            'broken' => ProjectorState::Broken->value,
            'stalled' => ProjectorState::Stalled->value,
        ]);

        $projectors = new ProjectorCollection();

        foreach($data as $projector) {
            $projectors[] = new Projector($projector->id, $projector->name, ProjectorState::from($projector->state), ProjectorMode::from($projector->mode));
        }

        return $projectors;
    }
}
