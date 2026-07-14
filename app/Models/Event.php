<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $casts = [
        "title" => "array",
        "tag" => "array",
        "month" => "array",
        "loc" => "array",
        "desc" => "array",
        "long_desc" => "array",
        "show_video_on_cover" => "boolean"
    ];

    protected $guarded = [];

    //
}
