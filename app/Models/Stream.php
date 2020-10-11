<?php

namespace App\Models;

use App\Http\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    use Filterable;

    protected $fillable = [
        'id', 'channelId', 'gameId', 'service', 'viewerCount', 'createdAt',
    ];
}
