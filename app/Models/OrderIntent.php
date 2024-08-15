<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderIntent extends Model
{
    use HasFactory;

    protected $table = 'order_intents'; // Nom de la table

    protected $fillable = [
        'order_intent_price',
        'order_intent_type',
        'user_email',
        'user_phone',
        'expiration_date',
    ];

    protected $dates = [
        'expiration_date',
    ];

    protected $primaryKey = 'order_intent_id'; // Assurez-vous que la clé primaire est correcte

    public $incrementing = true;

    protected $keyType = 'int';

    /**
     * Relation avec le modèle Ticket.
     *
     * Une intention de commande peut avoir plusieurs tickets associés.
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'order_intent_id');
    }

    // Définir la relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

