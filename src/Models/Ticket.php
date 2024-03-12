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

    public static function percentageOfResolvedTickets(bool $confidential, ?int $userId = null): float|int
    {
        // Check if confidential flag is true and user ID is provided
        if ($confidential && $userId !== null) {
            // Get the total number of tickets
            $totalTickets = self::where('user_id', $userId)->count();

            // Get the number of tickets created by the specified user with status set to false
            $resolvedTickets = self::where('user_id', $userId)
                ->where('status', false)
                ->count();
        } else {
            // Get the total number of tickets
            $totalTickets = self::count();

            // Get the number of tickets with status set to false
            $resolvedTickets = self::where('status', false)->count();
        }

        // Calculate the percentage
        if ($totalTickets > 0) {
            $percentageResolved = ($resolvedTickets / $totalTickets) * 100;
        } else {
            $percentageResolved = 0; // Set to 0 if there are no tickets
        }

        return $percentageResolved;
    }

    public function getCount(?int $userId = null)
    {
        return $userId !== null ? self::where('user_id', $userId)->count() : self::count();
    }

    public function getAnalyticCard(bool $confidential, ?int $userId = null): array
    {
        return [
            'label' => __('support_ticket.title'),
            'icon' => 'bi bi-ticket-perforated',
            'count' => $confidential ? $this->getCount($userId) : $this->getCount(),
            'percent' => $confidential ? $this->percentageOfResolvedTickets(true, $userId) : $this->percentageOfResolvedTickets(false),
            'message' => __('support_ticket.analytics.message')
        ];
    }
}
