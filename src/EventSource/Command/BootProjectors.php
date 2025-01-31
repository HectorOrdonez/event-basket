<?php

namespace EventBasket\EventSource\Command;

use EventBasket\EventSource\Projection\ProjectionistInterface;
use Illuminate\Console\Command;

class BootProjectors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'projectionist:boot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The projectionist finds and boots projectors that so require.';

    /**
     * Execute the console command.
     */
    public function handle(ProjectionistInterface $projectionist): void
    {
        $projectionist->boot();
    }
}
