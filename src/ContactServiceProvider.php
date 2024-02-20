<?php

namespace Bunker\SiteContact;

use Illuminate\Support\ServiceProvider;

class ContactServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'site-contact');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->mergeConfigFrom(__DIR__ . '/config/site-contact.php', 'site-contact');
        $this->publishes([__DIR__ . '/config/site-contact.php' => config_path('site-contact.php')]);
    }

    public function register()
    {

    }


}
