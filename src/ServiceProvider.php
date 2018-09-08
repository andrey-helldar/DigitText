<?php

namespace Helldar\DigitText;

use Helldar\DigitText\Services\DigitText;
use Helldar\DigitText\Variables\DigitTextConstants;

/**
 * Class ServiceProvider
 */
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__ . '/lang', DigitTextConstants::PACKAGE_NAME);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton(DigitTextConstants::PACKAGE_NAME, DigitText::class);
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function provides()
    {
        return [DigitTextConstants::PACKAGE_NAME];
    }
}
