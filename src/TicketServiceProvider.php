<?php

namespace Bunker\SupportTicket;

use Illuminate\Support\ServiceProvider;
use Bunker\SupportTicket\database\seeders\SupportTicketSeeder;

class TicketServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views/support-ticket', 'support-ticket');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'support-ticket');
        $this->mergeConfigFrom(__DIR__ . '/config/support_ticket.php', 'support-ticket');
        $this->publishes([__DIR__ . '/config/support_ticket.php' => config_path('support_ticket.php'), __DIR__ . '/resources/lang' => resource_path('lang'), __DIR__ . '/resources/views/support-ticket' => resource_path('views/pages/support-ticket'), __DIR__ . '/database/seeders/DatabaseSeeder.php' => database_path('seeders/SupportTicketSeeder.php'),], 'support_ticket');
    }


    public function register()
    {

    }

}
