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
     *     operationId="GetEvent",
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Parameter(
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
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Unable to fetch events"
     *     )
     * )
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->query('perPage', 10);
            if (!is_numeric($perPage) || $perPage <= 0) {
                return response()->json(['error' => 'Invalid pagination size'], 400);
            }

            $events = Event::where('event_status', 'upcoming')->paginate((int)$perPage);

            return response()->json($events);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch events'], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/v1/events",
     *     tags={"Events"},
     *     summary="Create a new event",
     *     description="Create a new event with the provided details.",
     *     operationId="StoreEvent",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"event_category", "event_title", "event_date", "event_city", "event_address", "event_status"},
     *             @OA\Property(property="event_category", type="string", example="Music"),
     *             @OA\Property(property="event_title", type="string", example="Concert de Rock"),
     *             @OA\Property(property="event_description", type="string", example="Un concert de rock avec les plus grandes stars."),
     *             @OA\Property(property="event_date", type="string", format="date-time", example="2024-09-15T20:00:00Z"),
     *             @OA\Property(property="event_image", type="string", example="https://example.com/images/concert.jpg"),
     *             @OA\Property(property="event_city", type="string", example="Paris"),
     *             @OA\Property(property="event_address", type="string", example="Stade de France, 93216 Saint-Denis"),
     *             @OA\Property(property="event_status", type="string", example="upcoming"),
     *             @OA\Property(property="event_created_on", type="string", format="date-time", example="2024-08-14T12:00:00Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Ticket type created successfully",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function store(Request $request)
    {
        // Valider les données entrantes
        $validatedData = $request->validate([
            'event_category' => 'required|string|max:255',
            'event_title' => 'required|string|max:255',
            'event_description' => 'required|string|max:65535',
            'event_date' => 'required|date_format:Y-m-d\TH:i:s\Z',
            'event_image' => 'nullable|string|max:255',
            'event_city' => 'required|string|max:255',
            'event_address' => 'required|string|max:255',
            'event_status' => 'required|string|in:upcoming,cancelled,completed',
            'event_created_on' => 'required|date',
        ]);

        // Convertir la date au format MySQL
        $validatedData['event_date'] = \Carbon\Carbon::parse($validatedData['event_date'])->format('Y-m-d H:i:s');

        // Créer un nouvel événement en utilisant les données validées
        $event = new Event($validatedData);
        $event->save();

        // Retourner la réponse JSON avec l'événement créé
        return response()->json($event, 201);
    }



    /**
     * @OA\Get(
     *     path="/api/v1/events/{event}",
     *     tags={"Events"},
     *     summary="Get event by ID",
     *     description="Retrieve details of a specific event by its ID.",
     *     operationId="ShowEvent",
     *     @OA\Parameter(
     *         name="event",
     *         in="path",
     *         description="ID of the event",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
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
    public function show($id)
    {
        try {
            $event = Event::findOrFail($id);
            return response()->json($event);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Event not found'], 404);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve event'], 500);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/v1/events/{event}",
     *     tags={"Events"},
     *     summary="Update an existing event",
     *     description="Update details of an existing event by its ID.",
     *     operationId="UpdateEvent",
     *     @OA\Parameter(
     *         name="event",
     *         in="path",
     *         description="ID of the event",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"event_category", "event_title", "event_date", "event_city", "event_address", "event_status"},
     *             @OA\Property(property="event_category", type="string", example="Music"),
     *             @OA\Property(property="event_title", type="string", example="Concert de Rock"),
     *             @OA\Property(property="event_description", type="string", example="Un concert de rock avec les plus grandes stars."),
     *             @OA\Property(property="event_date", type="string", format="date-time", example="2024-09-15T20:00:00Z"),
     *             @OA\Property(property="event_image", type="string", example="https://example.com/images/concert.jpg"),
     *             @OA\Property(property="event_city", type="string", example="Paris"),
     *             @OA\Property(property="event_address", type="string", example="Stade de France, 93216 Saint-Denis"),
     *             @OA\Property(property="event_status", type="string", example="upcoming"),
     *             @OA\Property(property="event_created_on", type="string", format="date-time", example="2024-08-14T12:00:00Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Event updated successfully",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     * )
     */
    public function update(Request $request, Event $event)
    {
        // Valider les données entrantes
        $validatedData = $request->validate([
            'event_category' => 'sometimes|required|string|max:255',
            'event_title' => 'sometimes|required|string|max:255',
            'event_description' => 'sometimes|required|string|max:65535',
            'event_date' => 'sometimes|required|date_format:Y-m-d\TH:i:s\Z',
            'event_image' => 'nullable|string|max:255',
            'event_city' => 'sometimes|required|string|max:255',
            'event_address' => 'sometimes|required|string|max:255',
            'event_status' => 'sometimes|required|string|in:upcoming,cancelled,completed',
            'event_created_on' => 'sometimes|required|date',
        ]);

        // Convertir la date au format MySQL si elle est présente dans les données validées
        if (isset($validatedData['event_date'])) {
            $validatedData['event_date'] = \Carbon\Carbon::parse($validatedData['event_date'])->format('Y-m-d H:i:s');
        }

        // Mettre à jour l'événement avec les données validées
        $event->update($validatedData);

        // Retourner la réponse JSON avec l'événement mis à jour
        return response()->json($event);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/events/{event}",
     *     tags={"Events"},
     *     summary="Delete an event",
     *     description="Delete a specific event by its ID.",
     *     operationId="DestroyEvent",
     *     @OA\Parameter(
     *         name="event",
     *         in="path",
     *         description="ID of the event",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Event deleted successfully",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     )
     * )
     */
    public function destroy($id)
    {
        try {
            $event = Event::findOrFail($id);
            $event->delete();
            return response()->json(['message' => 'Event deleted successfully']);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Event not found'], 404);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete event'], 500);
        }
    }
}
