<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    protected $casts = [
        "title" => "array",
        "tag" => "array",
        "desc" => "array",
        "gallery" => "array",
        "show_video_on_cover" => "boolean"
    ];

    protected $guarded = [];

    //
}
