<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\TicketTypeController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\OrderIntentController;

/**
 * 
 * -- Evènements --
 * GET /api/v1/events => Récupérer tous les évènements
 * POST /api/v1/events => Créer un nouvel évènement
 * GET /api/v1/events/{event} => Afficher un évènement
 * PUT /api/v1/events/{event} => Mettre à jour un èvènement
 * DELETE /api/v1/events/{event} => Supprimer un évènement
 * 
 * -- Types de Tickets --
 * GET /api/v1/events/{event_id}/ticket-types => Récupérer tous les types de tickets
 * POST /api/v1/events/{event_id}/ticket-types => Créer un nouveau type de ticket
 * GET /api/v1/events/{event_id}/ticket-types/{ticket_type_id} => Afficher un type de ticket
 * PUT /api/v1/events/{event_id}/ticket-types/{ticket_type_id} => Mettre à jour un type de ticket
 * DELETE /api/v1/events/{event_id}/ticket-types/{ticket_type_id} => Supprimer un type de ticket       
 * 
 * -- Intentions de commande --
 * GET /api/v1/order-intents (Index) => Récupérer les intentions de commande
 * POST /api/v1/order-intents (Store) => Créer une intention de commande
 * GET /api/v1/order-intents/{order_intent} (Show) => Afficher une intention de commande
 * PUT /api/v1/order-intents/{order_intent} (Update) => Mettre à jour une intentio de commande
 * DELETE /api/v1/order-intents/{order_intent} (Destroy) => Supprimer une intention de commande
 * 
 * -- Valider une intention de commande --
 * Valider une itention de commande à consister à mettre une intention de commande qui avait pour statut
 * "pending" à "validated et à générer un lien de téléchargement vers le ticket de la commande.
 * Pour ce faire, il a fallu rajouter au modèle OrderIntent un attribut "order_intent_status" avec une valeur 
 * par défaut qui est "pending".
 * 
 * POST /api/v1/order-intents/{id}/validate
 * 
 * -- Consulter toutes les commandes effectuées par le client (utilisateur de l'API) --
 * GET /api/v1/users/{user_id}/orders => Récupérer les commandes liées à un client
 * 
 * -- Proposition d’autres endpoints et fonctionnalités à fournir au utilisateurs de l’API --
 * 
 * GET /api/v1/users/{user_id}/order-intents => Récupérer les intentions de commandes d'un client
 * 
 * Récupérer les intentions de commandes d'un client dans les buts suivants :
 * 1-  Suivre et gérer des commandes
 * 2-  Relancer des commandes inachevées
 * 3-  Service client : Les équipes de support peuvent accéder aux intentions de commande pour 
 *     répondre aux questions des clients concernant leurs achats, résoudre des problèmes ou 
 *     traiter des réclamations.
 * 4-  Analyse et marketing
 * 5-  Gestion des stocks
 * 6-  Personnalisation de l'expérience utilisateur
 * 7-  Historique d'achat
 * 
 */
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function() {
    Route::apiResource('events', EventController::class);
    Route::apiResource('order-intents', OrderIntentController::class);
    Route::apiResource('events/{event}/ticket-types', TicketTypeController::class);

    Route::post('order-intents/{id}/validate', [OrderIntentController::class, 'validateOrderIntent']);

    Route::get('users/{user_id}/orders', [OrderController::class, 'getOrdersByUserId']);

    // Bonus : Proposition d'API
    Route::get('users/{user_id}/order-intents', [OrderIntentController::class, 'getOrderIntentsByUserId']);
});