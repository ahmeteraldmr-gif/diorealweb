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
