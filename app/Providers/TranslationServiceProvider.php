<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $locales = $this->filterLocales(request()->header('Accept-Language', ''));
        app()->setLocale($locales[0]);
        if (true == env('APP_DEBUG', false) && Cache::has('translations')) {
            Cache::forget('translations');
        }
        Cache::rememberForever('translations', function () {
            return $this->getTranslations();
        });
    }

    protected function filterLocales($raw)
    {
        $list = [];
        $locales = [];
        $system = [
            config('app.locale'),
            config('app.fallback_locale'),
            'en',
        ];
        if (is_string($raw) && !empty($raw)) {
            foreach (array_map('trim', explode(';', trim($raw))) as $tmp) {
                foreach (array_map('trim', explode(',', $tmp)) as $locale) {
                    if (!empty($locale) && !in_array($locale, $list)) {
                        $list[] = $locale;
                    }
                }
            }
        }

        foreach ($system as $locale) {
            if (!in_array($locale, $list)) {
                $list[] = $locale;
            }
        }

        foreach ($list as $locale) {
            $path = resource_path('lang/'.$locale);
            if (file_exists($path) && is_dir($path) && is_readable($path)) {
                $locales[] = $locale;
            }
        }

        return $locales;
    }

    private function getTranslations()
    {
        $path = resource_path('lang/'.App::getLocale());

        return collect(File::allFiles($path))->flatMap(function ($file) {
            $key = ($translation = $file->getBasename('.php'));

            return [$key => trans($translation)];
        });
    }
}
