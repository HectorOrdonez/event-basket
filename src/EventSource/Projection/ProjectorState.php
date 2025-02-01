<?php

namespace EventBasket\EventSource\Projection;

use Illuminate\Support\Collection;

enum ProjectorState: string
{
    // A projector that is waiting to be booted
    case Pending = 'pending';

    // The natural state of a projector; it is ready and actively projecting events
    case Playing = 'playing';

    // A projector that is catching up on all event from the beginning of time
    case Booting = 'booting';

    // A projector that finished booting and is now waiting to be played
    case Booted = 'booted';

    // A projector that encountered an issue while booting or playing
    case Broken = 'broken';

    // A projector whose booting procedure stopped because another projector broke
    case Stalled = 'stalled';
}
