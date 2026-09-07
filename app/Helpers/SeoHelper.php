<?php

namespace App\Helpers;

class SeoHelper
{
    public static function title(?string $title = null): string
    {
        return $title ? $title . ' - Öğrenci Takip' : 'Öğrenci Takip Sistemi';
    }
}
