<?php

namespace Bunker\SupportTicket;

use Illuminate\Support\ServiceProvider;

class TicketServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Load routes for the support ticket package
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        // Load views for the support ticket package
        $this->loadViewsFrom(__DIR__ . '/resources/views/support-ticket', 'support-ticket');

        // Load migrations for the support ticket package
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        // Load translations for the support ticket package
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'support-ticket');

        // Merge configuration for the support ticket package
        $this->mergeConfigFrom(__DIR__ . '/config/support_ticket.php', 'support-ticket');

        // Publish configuration, language files, views, and seeders for the support ticket package
        $this->publishes([
            __DIR__ . '/config/support_ticket.php' => config_path('support_ticket.php'),
            __DIR__ . '/resources/lang' => resource_path('lang/'),
            __DIR__ . '/resources/views/support-ticket' => resource_path('views/pages/support-ticket'),
            __DIR__ . '/database/seeders/SupportTicketSeeder.php' => database_path('seeders/SupportTicketSeeder.php')
        ], 'support_ticket');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Placeholder for any registration logic if needed
    }
}
