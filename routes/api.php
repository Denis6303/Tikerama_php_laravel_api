<?php

use App\Http\Controllers\Api\V1\OrderIntentController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\TicketTypeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

/**
 * 
 * Types de Tickets
 * GET /api/v1/events/{event_id}/ticket-types => Récupérer tous les types de tickets
 * POST /api/v1/events/{event_id}/ticket-types => Créer un nouveau type de ticket
 * GET /api/v1/events/{event_id}/ticket-types/{ticket_type_id} => Afficher un type de ticket
 * PUT /api/v1/events/{event_id}/ticket-types/{ticket_type_id} => Mettre à jour un type de ticket
 * DELETE /api/v1/events/{event_id}/ticket-types/{ticket_type_id} => Supprimer un type de ticket       
 * 
 * Intentions de commande
 * GET /api/v1/order-intents (Index) => Récupérer les intentions de commande
 * POST /api/v1/order-intents (Store) => Enregistrer une intention de commande
 * GET /api/v1/order-intents/{order_intent} (Show) => Afficher une intention de commande
 * PUT /api/v1/order-intents/{order_intent} (Update) => Mettre à jour une intentio de commande
 * DELETE /api/v1/order-intents/{order_intent} (Destroy) => Supprimer une intention de commande
 */
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function() {
    Route::apiResource('events', EventController::class);
    Route::apiResource('order-intents', OrderIntentController::class);
    Route::apiResource('events/{event}/ticket-types', TicketTypeController::class);
});

/**
* Récupérer tous les types de tickets disponibles pour un événement spécifique
*/
// Route::get('events/{event}/ticket-types', [TicketTypeController::class, 'index']);


/**
* GET /api/v1/order-intents (Index) => Récupérer les intentions de commande
* 
* POST /api/v1/order-intents (Store) => Enregistrer une intention de commande
*
* GET /api/v1/order-intents/{order_intent} (Show) => Afficher une intention de commande
*
* DELETE /api/v1/order-intents/{order_intent} (Destroy) => Supprimer une intention de commande
*/
// Route::prefix('v1')->group(function () {
//     Route::apiResource('order-intents', OrderIntentController::class);
// });