<?php

namespace Bunker\SiteContact\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteContact extends Model
{
    use HasFactory;

    protected $table = 'site_contacts';
    protected $fillable = ['visitor_name','visitor_email', 'message', 'status'];

}
