<?php

namespace EventBasket\EventSource\Projection;

enum ProjectorMode: string
{
    // Projectors that need to project all events
    case RunFromBeginning = 'runFromBeginning';
    // Projectors that need to project from the moment they go live
    case RunFromNow = 'runFromNow';
    // Projectors that need to run once from the beginning of time and no more
    case RunOnce = 'runOnce';
}
