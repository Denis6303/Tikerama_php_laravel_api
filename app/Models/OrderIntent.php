<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderIntent extends Model
{
    use HasFactory;

    protected $table = 'order_intents'; // Pour correspondre au nom de la table

    public function tickets()
    {
        // Ajouter une relation si nécessaire
    }
}
