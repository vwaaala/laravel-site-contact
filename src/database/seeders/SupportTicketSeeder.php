<?php

namespace Bunker\SupportTicket\database\seeders;

use Bunker\SupportTicket\Models\Ticket;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SupportTicketSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'support_ticket_create',
            'support_ticket_edit',
            'support_ticket_delete',
            'support_ticket_show',
        ];

        // Looping and Inserting Array's Permissions into Permission Table
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        $super = Role::where(['name' => 'Super Admin'])->first();
        $super->givePermissionTo($permissions);

        Ticket::create(['uuid' => str()->uuid(), 'name' => 'John Doe Ticket', 'email' => 'ticket@gmail.com', 'message' => 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available.']);
    }
}
