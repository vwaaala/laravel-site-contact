<?php

namespace Bunker\SupportTicket\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Reply extends Model
{
    use HasFactory;

    protected $table = 'ticket_replies';
    protected $fillable = ['uuid', 'ticket_id', 'replied_user_id', 'reply'];

    public function ticket(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function repliedBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'replied_user_id');
    }
}
