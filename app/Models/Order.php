<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders'; // Nom de la table

    protected $fillable = [
        'order_number',
        'order_event_id',
        'order_price',
        'order_type',
        'order_payment',
        'order_info',
        'order_created_on',
    ];

    protected $primaryKey = 'order_id'; // Assurez-vous que la clé primaire est correcte

    public $incrementing = true;

    protected $keyType = 'int';

    /**
     * Relation avec le modèle Event.
     *
     * Une commande appartient à un événement.
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'order_event_id');
    }

    /**
     * Relation avec le modèle Ticket.
     *
     * Une commande peut avoir plusieurs tickets associés.
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'ticket_order_id');
    }

    /**
     * Relation avec le modèle User.
     *
     * Une commande appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
