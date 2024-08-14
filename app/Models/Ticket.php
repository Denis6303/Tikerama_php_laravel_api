<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets'; // Assurez-vous que ce nom est correct

    protected $primaryKey = 'ticket_id'; // Ajustez en fonction de votre clé primaire

    public $incrementing = true;

    protected $keyType = 'int';

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ticket_event_id',
        'ticket_email',
        'ticket_phone',
        'ticket_price',
        'ticket_order_id',
        'ticket_key',
        'ticket_ticket_type_id',
        'ticket_status',
        'ticket_created_on',
    ];

    /**
     * Les attributs qui devraient être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'ticket_created_on' => 'datetime',
    ];

    /**
     * Relation avec le modèle Event.
     *
     * Un ticket appartient à un événement.
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'ticket_event_id');
    }

    /**
     * Relation avec le modèle TicketType.
     *
     * Un ticket est associé à un type de ticket.
     */
    public function ticketType()
    {
        return $this->belongsTo(TicketType::class, 'ticket_ticket_type_id');
    }

    /**
     * Relation avec le modèle Order.
     *
     * Un ticket appartient à une commande.
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'ticket_order_id');
    }

    /**
     * Relation avec le modèle OrderIntent.
     *
     * Un ticket peut être associé à une intention de commande.
     */
    public function orderIntent()
    {
        return $this->belongsTo(OrderIntent::class, 'order_intent_id');
    }
}
