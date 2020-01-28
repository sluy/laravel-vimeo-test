<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class TranslationController extends Controller
{
    /**
     * Returns current locale words.
     */
    public function index()
    {
        return $this->show();
    }

    /**
     * Returns specific locale words.
     *
     * @param mixed $locale
     */
    public function show($locale = null)
    {
        if (!is_string($locale) || empty($locale)) {
            $locale = app()->getLocale();
        } else {
            app()->setLocale($locale);
        }
        $path = resource_path('lang/'.$locale);

        if (!file_exists($path) || !is_dir($path) || !is_readable($path)) {
            $fallback = config('app.fallback_locale', 'en');

            return ($fallback !== $locale)
                ? $fallback
                : response()->json([]);
        }

        return response()->json(collect(File::allFiles($path))->flatMap(function ($file) {
            $key = ($translation = $file->getBasename('.php'));

            return [$key => trans($translation)];
        }));
    }
}
