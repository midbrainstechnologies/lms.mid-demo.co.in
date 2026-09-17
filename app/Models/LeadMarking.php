<?php

namespace App\Models;

class LeadMarking
{
    const LABELS = [
        'hot'    => 'Hot',
        'warm'   => 'Warm',
        'cold'   => 'Cold',
        'dead'   => 'Dead',
        'closed' => 'Closed',
    ];

    const BGCOLORS = [
        'hot'    => 'red',
        'warm'   => 'orange',
        'cold'   => 'aqua',
        'dead'   => 'gray',
        'closed' => 'green',
    ];
}
