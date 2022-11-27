<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class ClientsController extends Controller
{
    /**
     * Display login page OR redirect to authors section if client has logged.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (session('token_key')) {
            return redirect('/authors');
        }
        return view('login');
    }

    /**
     * Login Client.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // Validate email/password.

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ]);
        if ($validator->fails()) {
            $messages = [];
            foreach ($validator->errors()->all() as $error) {
                $messages['error'][] = $error;
            }
            // Send message if received invalid data.
            return redirect('/')->with('status', $messages);
        }

        // get API base url from .env file
        $apiURL = getenv('SAAS_API_URL') . '/api/v2/token';

        $postInput = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // send the post request to API
        $response = Http::post($apiURL, $postInput);

        $statusCode = $response->status();

        // check API response status
        if ($statusCode == 200) {
            $responseBody = json_decode($response->getBody());

            if (isset($responseBody->token_key) and !empty($responseBody->token_key)) {
                // store "token_key" in session storage that will use in other sections
                session(['token_key' => $responseBody->token_key]);
                return redirect('/authors');
            } else {
                // send message if "token_key" not found in the API response
                $messages['error'][] = 'Something went wrong!';
                return redirect('/')->with('status', $messages);
            }
        } else {
            // send message if API status is not 200
            $messages['error'][] = 'Email and password do not match!';
            return redirect('/')->with('status', $messages);
        }
    }
}
