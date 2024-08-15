<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\TicketType;
use App\Models\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/events/{event}/ticket-types",
     *     tags={"Ticket Types"},
     *     summary="Get all ticket types for a specific event with pagination",
     *     description="Retrieve the list of ticket types available for a given event, with pagination support.",
     *     operationId="getTicketTypesForEvent",
     *     @OA\Parameter(
     *         name="event",
     *         in="path",
     *         description="ID of the event",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
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
     *     )
     * )
     */
    public function index(Event $event, Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $ticketTypes = $event->ticketTypes()->paginate($perPage);
        return response()->json($ticketTypes);
    }

    /**
     * Store a newly created ticket type for an event.
     *
     * @OA\Post(
     *     path="/api/v1/events/{event}/ticket-types",
     *     tags={"Ticket Types"},
     *     summary="Create a new ticket type for a specific event",
     *     description="Create and store a new ticket type associated with a specific event.",
     *     operationId="createTicketType",
     *     @OA\Parameter(
     *         name="event",
     *         in="path",
     *         description="ID of the event",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"ticket_type_name", "ticket_type_price", "ticket_type_quantity", "ticket_type_real_quantity", "ticket_type_total_quantity"},
     *             @OA\Property(property="ticket_type_name", type="string", example="VIP"),
     *             @OA\Property(property="ticket_type_price", type="number", format="float", example=99.99),
     *             @OA\Property(property="ticket_type_quantity", type="integer", example=100),
     *             @OA\Property(property="ticket_type_real_quantity", type="integer", example=90),
     *             @OA\Property(property="ticket_type_total_quantity", type="integer", example=100),
     *             @OA\Property(property="ticket_type_description", type="string", example="VIP access with exclusive benefits.")
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
    public function store(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'ticket_type_name' => 'required|string|max:255',
            'ticket_type_price' => 'required|numeric|min:0',
            'ticket_type_quantity' => 'required|integer|min:0',
            'ticket_type_real_quantity' => 'required|integer|min:0',
            'ticket_type_total_quantity' => 'required|integer|min:0',
            'ticket_type_description' => 'nullable|string|max:65535',
        ]);

        $ticketType = new TicketType($validatedData);
        $ticketType->ticket_type_event_id = $event->event_id;
        $ticketType->save();

        return response()->json($ticketType, 201);
    }

    /**
     * Display the specified ticket type for an event.
     *
     * @OA\Get(
     *     path="/api/v1/events/{event}/ticket-types/{ticketType}",
     *     tags={"Ticket Types"},
     *     summary="Get a specific ticket type for a specific event",
     *     description="Retrieve details of a specific ticket type for a given event.",
     *     operationId="getTicketType",
     *     @OA\Parameter(
     *         name="event",
     *         in="path",
     *         description="ID of the event",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="ticketType",
     *         in="path",
     *         description="ID of the ticket type",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ticket type not found"
     *     )
     * )
     */
    public function show(Event $event, TicketType $ticketType)
    {
        if ($ticketType->ticket_type_event_id !== $event->event_id) {
            return response()->json(['error' => 'Ticket type not found for this event'], 404);
        }

        return response()->json($ticketType);
    }

    /**
     * Update the specified ticket type for an event.
     *
     * @OA\Put(
     *     path="/api/v1/events/{event}/ticket-types/{ticketType}",
     *     tags={"Ticket Types"},
     *     summary="Update a specific ticket type for a specific event",
     *     description="Update details of a specific ticket type for a given event.",
     *     operationId="updateTicketType",
     *     @OA\Parameter(
     *         name="event",
     *         in="path",
     *         description="ID of the event",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="ticketType",
     *         in="path",
     *         description="ID of the ticket type",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"ticket_type_name", "ticket_type_price", "ticket_type_quantity", "ticket_type_real_quantity", "ticket_type_total_quantity"},
     *             @OA\Property(property="ticket_type_name", type="string", example="VIP"),
     *             @OA\Property(property="ticket_type_price", type="number", format="float", example=99.99),
     *             @OA\Property(property="ticket_type_quantity", type="integer", example=100),
     *             @OA\Property(property="ticket_type_real_quantity", type="integer", example=90),
     *             @OA\Property(property="ticket_type_total_quantity", type="integer", example=100),
     *             @OA\Property(property="ticket_type_description", type="string", example="VIP access with exclusive benefits.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ticket type updated successfully",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function update(Request $request, Event $event, TicketType $ticketType)
    {
        if ($ticketType->ticket_type_event_id !== $event->event_id) {
            return response()->json(['error' => 'Ticket type not found for this event'], 404);
        }

        $validatedData = $request->validate([
            'ticket_type_name' => 'sometimes|required|string|max:255',
            'ticket_type_price' => 'sometimes|required|numeric|min:0',
            'ticket_type_quantity' => 'sometimes|required|integer|min:0',
            'ticket_type_real_quantity' => 'sometimes|required|integer|min:0',
            'ticket_type_total_quantity' => 'sometimes|required|integer|min:0',
            'ticket_type_description' => 'nullable|string|max:65535',
        ]);

        $ticketType->update($validatedData);

        return response()->json($ticketType);
    }

    /**
     * Remove the specified ticket type from storage.
     *
     * @OA\Delete(
     *     path="/api/v1/events/{event}/ticket-types/{ticketType}",
     *     tags={"Ticket Types"},
     *     summary="Delete a specific ticket type for a specific event",
     *     description="Delete a specific ticket type associated with a given event.",
     *     operationId="deleteTicketType",
     *     @OA\Parameter(
     *         name="event",
     *         in="path",
     *         description="ID of the event",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="ticketType",
     *         in="path",
     *         description="ID of the ticket type",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Ticket type deleted successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ticket type not found"
     *     )
     * )
     */
    public function destroy(Event $event, TicketType $ticketType)
    {
        if ($ticketType->ticket_type_event_id !== $event->event_id) {
            return response()->json(['error' => 'Ticket type not found for this event'], 404);
        }

        $ticketType->delete();

        return response()->json(null, 204);
    }
}
