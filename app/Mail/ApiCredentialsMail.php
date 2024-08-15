<?php

namespace App\Mail;

use App\Models\ApiAccessRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApiCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $apiAccessRequest;

    public function __construct(ApiAccessRequest $apiAccessRequest)
    {
        $this->apiAccessRequest = $apiAccessRequest;
    }

    public function build()
    {
        return $this->view('emails.api_credentials')
                    ->subject('Your API Access Credentials')
                    ->with([
                        'api_key' => $this->apiAccessRequest->api_key,
                        'api_secret' => $this->apiAccessRequest->api_secret,
                    ]);
    }
}

