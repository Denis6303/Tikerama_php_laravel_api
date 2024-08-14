<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    use HasFactory;

    // Définir le nom de la table si ce n'est pas le pluriel de la classe
    protected $table = 'ticket_types';

    // Définir la clé primaire si elle ne suit pas la convention 'id'
    protected $primaryKey = 'ticket_type_id';

    // Indiquer si les timestamps doivent être gérés automatiquement
    public $timestamps = false;

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = [
        'ticket_type_event_id',
        'ticket_type_name',
        'ticket_type_price',
        'ticket_type_quantity',
        'ticket_type_real_quantity',
        'ticket_type_total_quantity',
        'ticket_type_description',
    ];

    /**
     * Get the event associated with the ticket type.
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'ticket_type_event_id');
    }

    /**
     * Get the tickets associated with the ticket type.
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'ticket_ticket_type_id');
    }
}
