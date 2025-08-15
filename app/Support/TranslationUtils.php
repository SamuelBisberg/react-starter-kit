<?php

namespace App\Support;

use Illuminate\Support\Collection;

/**
 * Handles translation-related functionality.
 */
class TranslationUtils
{
    /**
     * Get the translated string for all locales.
     */
    public static function translatedToAllLocales(string $key, array $replace = []): Collection
    {
        $currentLocale = app()->getLocale();

        try {
            return collect(config('app.supported_locales', ['he', 'en']))
                ->flatMap(
                    function (string $locale) use ($key, $replace) {
                        app()->setLocale($locale);

                        $translation = __($key, $replace);

                        return [$locale => $translation];
                    }
                );
        } finally {
            app()->setLocale($currentLocale);
        }
    }
}
