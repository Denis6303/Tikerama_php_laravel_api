<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\OrderIntent;
use Illuminate\Http\Request;

class OrderIntentController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/order-intents",
     *     tags={"Order Intents"},
     *     summary="Get all order intents",
     *     description="Retrieve a list of order intents with pagination",
     *     operationId="getOrderIntents",
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
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
    public function index()
    {
        // Retourner toutes les intentions de commande avec pagination
        return OrderIntent::paginate(10);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/order-intents",
     *     tags={"Order Intents"},
     *     summary="Create a new order intent",
     *     description="Store a new order intent",
     *     operationId="StoreOrderIntents",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"order_intent_price", "order_intent_type", "user_email", "user_phone", "expiration_date"},
     *             @OA\Property(property="order_intent_price", type="number", format="float", example=99.99),
     *             @OA\Property(property="order_intent_type", type="string", example="VIP"),
     *             @OA\Property(property="user_email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="user_phone", type="string", example="1234567890"),
     *             @OA\Property(property="expiration_date", type="string", format="date-time", example="2024-12-31T23:59:59Z")
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
        // Validation des données
        $validatedData = $request->validate([
            'order_intent_price' => 'required|numeric',
            'order_intent_type' => 'required|string|max:50',
            'user_email' => 'required|email|max:100',
            'user_phone' => 'required|string|max:20',
            'expiration_date' => 'required|date',
        ]);

        // Création de l'intention de commande
        $orderIntent = OrderIntent::create($validatedData);

        return response()->json($orderIntent, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/order-intents/{id}",
     *     tags={"Order Intents"},
     *     summary="Get a specific order intent",
     *     description="Retrieve a specific order intent by ID",
     *     operationId="ShowOrderIntents",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Order intent ID",
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
        // Afficher une intention de commande par ID
        $orderIntent = OrderIntent::findOrFail($id);
        return response()->json($orderIntent);
    }

    /**
     * @OA\Put(
     *     path="/api/v1/order-intents/{id}",
     *     tags={"Order Intents"},
     *     summary="Update an existing order intent",
     *     description="Update an existing order intent by ID",
     *     operationId="UpdateOrderIntents",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Order intent ID",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="order_intent_price", type="number", format="float", example=99.99),
     *             @OA\Property(property="order_intent_type", type="string", example="VIP"),
     *             @OA\Property(property="user_email", type="string", format="email", example="user@example.com"),
     *             @OA\Property(property="user_phone", type="string", example="1234567890"),
     *             @OA\Property(property="expiration_date", type="string", format="date-time", example="2024-12-31T23:59:59Z")
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
    public function update(Request $request, $id)
    {
        // Validation des données
        $validatedData = $request->validate([
            'order_intent_price' => 'sometimes|numeric',
            'order_intent_type' => 'sometimes|string|max:50',
            'user_email' => 'sometimes|email|max:100',
            'user_phone' => 'sometimes|string|max:20',
            'expiration_date' => 'sometimes|date',
        ]);

        // Mise à jour de l'intention de commande
        $orderIntent = OrderIntent::findOrFail($id);
        $orderIntent->update($validatedData);

        return response()->json($orderIntent);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/order-intents/{id}",
     *     tags={"Order Intents"},
     *     summary="Delete an order intent",
     *     description="Delete an existing order intent by ID",
     *     operationId="DestroyOrderIntents",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Order intent ID",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Order intent deleted"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Order intent not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        // Suppression de l'intention de commande
        $orderIntent = OrderIntent::findOrFail($id);
        $orderIntent->delete();

        return response()->json(null, 204);
    }
}
