<?php

namespace App\Model;

use Database\Connections\DB;

class CallDetail extends Model
{
    protected $table = "call_details";

    protected $fields = [
        'call_id',
        'date',
        'details',
        'hours',
        'minutes'
    ];
}
