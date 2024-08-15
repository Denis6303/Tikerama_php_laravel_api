<?php

namespace App\Http\Controllers;

use App\Models\ApiAccessRequest;  // Ensure this line exists
use App\Mail\ApiCredentialsMail;  // Ensure this line exists
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller;  // Add this line

class ApiAccessRequestController extends Controller
{
    public function store(Request $request)
    {
        \Log::info('Received request: ', $request->all());

        try {
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:api_access_requests,email',
                'city' => 'required|string|max:255',
                'address' => 'required|string|max:255',
            ]);

            \Log::info('Validation passed. Storing the request.');

            // Generate API credentials
            $apiKey = Str::random(32);
            $apiSecret = Str::random(64);

            // Save the request with API credentials
            $apiAccessRequest = ApiAccessRequest::create(array_merge(
                $request->all(),
                ['api_key' => $apiKey, 'api_secret' => $apiSecret]
            ));

            \Log::info('Request stored successfully.');

            // Send email to the user with API credentials
            Mail::to($apiAccessRequest->email)->send(new ApiCredentialsMail($apiAccessRequest));

            return response()->json(['message' => 'Request submitted successfully. API credentials have been sent to your email.'], 201);
        } catch (\Exception $e) {
            \Log::error('Error occurred: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }
}
