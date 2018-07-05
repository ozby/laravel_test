<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Message extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $dates = [
        'time_sent',
    ];
}
