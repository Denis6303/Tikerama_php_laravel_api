<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EventController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/events",
     *     tags={"Events"},
     *     summary="Get all events",
     *     description="Retrieve the list of upcoming events",
     *     operationId="index",
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *      @OA\Parameter(
     *         name="perPage",
     *         in="query",
     *         description="Number of items per page",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             default=10
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     * )
     */
    public function index(Request $request)
    {
        try {
            // Nombre d'événements par page (configurable via une query string)
            $perPage = $request->query('per_page', 10); // 10 par défaut
            
            // Vérifier que perPage est un entier valide
            if (!is_numeric($perPage) || $perPage <= 0) {
                return response()->json(['error' => 'Invalid pagination size'], 400);
            }

            // Récupérer les événements avec pagination
            $events = Event::where('event_status', 'upcoming')->paginate((int)$perPage);

            return response()->json($events);

        } catch (\Exception $e) {
            // Gestion des erreurs générales
            return response()->json(['error' => 'Unable to fetch events'], 500);
        }
    }
}
