<?php

namespace Bunker\SupportTicket\database\seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([SupportTicketSeeder::class]);
    }
}
