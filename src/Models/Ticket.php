<?php

namespace Bunker\SiteContact\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'support_tickets';
    protected $fillable = ['name','email', 'message', 'status'];

}
