<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/users/{user_id}/orders",
     *     tags={"Orders"},
     *     summary="Get a user orders",
     *     description="Retrieve the list of a user orders",
     *     operationId="GetOrders",
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
    public function getOrdersByUserId($user_id, Request $request)
    {
        // Récupérer les commande associées à l'utilisateur
        $orders = Order::where('user_id', $user_id)
            ->paginate(10); // Pagination incluse

        // Retourner les résultats en JSON
        return response()->json($orders);
    }
}
