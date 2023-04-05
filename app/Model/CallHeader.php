<?php

namespace App\Model;

use Database\Connections\DB;

class CallHeader extends Model
{
    protected $table = "call_headers";

    protected $fields = [
        'call_id',
        'date',
        'it_person',
        'username',
        'subject',
        'details',
        'total_hours',
        'total_minutes',
        'status'
    ];
}
