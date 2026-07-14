<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

class Yacht extends Model
{
    use HasTranslations;

    protected $casts = [
        "name" => "array",
        "tag" => "array",
        "desc" => "array",
        "long_desc" => "array",
        "gallery" => "array",
        "show_video_on_cover" => "boolean"
    ];

    protected $guarded = [];

    //
}
