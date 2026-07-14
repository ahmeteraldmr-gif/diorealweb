<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

class Journal extends Model
{
    use HasTranslations;

    protected $casts = [
        "title" => "array",
        "desc" => "array",
        "tag" => "array",
        "content" => "array",
        "is_featured" => "boolean",
        "show_video_on_cover" => "boolean",
    ];

    protected $guarded = [];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
