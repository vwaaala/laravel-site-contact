<?php

namespace Bunker\SupportTicket\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'support_tickets';
    protected $fillable = ['uuid', 'subject', 'user_id', 'message', 'status'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function replies(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Reply::class, 'ticket_id')->orderByDesc('created_at');
    }

    public static function percentageResolvedTickets(bool $confidential)
    {
        // Get the total number of tickets
        $totalTickets = self::count();

        // when confidential use only user created tickets
        // Get the number of tickets with status set to false
        $resolvedTickets = self::where('status', false)->count();

        // Calculate the percentage
        if ($totalTickets > 0) {
            $percentageResolved = ($resolvedTickets / $totalTickets) * 100;
        } else {
            $percentageResolved = 0; // Set to 0 if there are no tickets
        }

        return $percentageResolved;
    }
}
