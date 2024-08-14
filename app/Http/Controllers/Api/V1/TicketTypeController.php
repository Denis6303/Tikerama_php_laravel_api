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
    public function index(Event $event)
    {
        $ticketTypes = $event->ticketTypes()->paginate(10);
        return response()->json($ticketTypes);
    }
}
