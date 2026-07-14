<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

class Destination extends Model
{
    use HasTranslations;

    protected $casts = [
        'name' => 'array',
        'region' => 'array',
        'desc' => 'array',
        'gallery' => 'array',
        'show_video_on_cover' => 'boolean',
    ];

    protected $guarded = [];

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }

    public function journals()
    {
        return $this->hasMany(Journal::class);
    }
}
