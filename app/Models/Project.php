<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    const STATUSES = [
        1 => 'planned',
        2 => 'running',
        3 => 'on_hold',
        4 => 'finished',
        5 => 'cancel',
    ];

    protected $fillable = [
        'name',
        'description',
        'status'
    ];
}
