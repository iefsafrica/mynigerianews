<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Traits\ApiResponse;
use App\Traits\ResponseMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactUsController extends Controller
{
    use ResponseMessage, ApiResponse;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);
        try {
            $contact_us = new Contact();
            $contact_us->name = $request->name;
            $contact_us->email = $request->email;
            $contact_us->website = $request->website??'';
            $contact_us->message = $request->message;
            $contact_us->save();
            if ($contact_us)
                return $this->successResponse($contact_us, $this->create_success_message['message']);
            else
                return $this->successResponse('', $this->create_fail_message['message']);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->errorResponse($this->create_fail_message['message']);
        }
    }
}
