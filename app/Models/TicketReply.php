<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    use HasFactory;

    public $table = 'ticket_replies';

    protected $fillable = [
        'reply_message',
        'customer_id',
        'ticket_id'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class);
    }
   
}
