<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Message extends Model
{
    const STATUS_READ = 'read';
    const STATUS_UNREAD = 'unread';

    protected $hidden = ['isArchived'];
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $dates = [
        'time_sent',
    ];

    /**
     * @var array
     */
    protected $attributes = [
        'status' => self::STATUS_UNREAD,
        'isArchived' => false,
    ];
}
