<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public $table = 'tickets';

    protected $fillable = [
        'subject',
        'ticket_message'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function ticket_replies(){
        return $this->hasMany(TicketReply::class);
    }

}
