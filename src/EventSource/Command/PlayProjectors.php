<?php

namespace EventBasket\EventSource\Command;

use EventBasket\EventSource\Projection\ProjectionistInterface;
use Illuminate\Console\Command;

class PlayProjectors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'projectionist:play';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The projectionist plays all projectors.';

    /**
     * Execute the console command.
     */
    public function handle(ProjectionistInterface $projectionist): void
    {
        $projectionist->play();
    }
}
