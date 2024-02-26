<?php

namespace Bunker\SupportTicket\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'support_tickets';
    protected $fillable = ['uuid', 'name', 'email', 'message', 'status'];

    public function replies(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Reply::class, 'ticket_id')->orderByDesc('created_at');
    }

}
