<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'ticket_event_id');
    }

    public function ticketTypes()
    {
        return $this->hasMany(TicketType::class, 'ticket_type_event_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'order_event_id');
    }
}
