<?php

namespace App\Traits;

trait HasTranslations
{
    /**
     * Get an attribute from the model and fallback empty/null English translations to Turkish.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        $casts = method_exists($this, 'getCasts') ? $this->getCasts() : ($this->casts ?? []);
        $isArrayCast = isset($casts[$key]) && ($casts[$key] === 'array' || $casts[$key] === 'json');

        if ($isArrayCast) {
            if (is_string($value) && trim($value) !== '') {
                $decoded = json_decode($value, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $value = $decoded;
                } else {
                    $value = ['tr' => $value, 'en' => $value];
                }
            } elseif (is_null($value) || !is_array($value)) {
                $value = ['tr' => '', 'en' => ''];
            }
        }

        // If the attribute is cast to array (like name, desc, tag, title, loc, month, etc.)
        // and contains the primary 'tr' key, fallback empty 'en' to 'tr'
        if (is_array($value) && isset($value['tr'])) {
            if (!isset($value['en']) || $value['en'] === null || (is_string($value['en']) && trim($value['en'], " .") === '')) {
                $value['en'] = $value['tr'];
            }
        }

        return $value;
    }
}
