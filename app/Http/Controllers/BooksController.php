<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BooksController extends Controller
{
    /**
    * Delete a book.
    *
    * @param  \Illuminate\Http\Request  $request
    */
    public function delete(Request $request)
    {
        // check user logs
        if (!session('token_key')) {
            return redirect('/');
        }


        // get API base url from .env file
        $apiURL = getenv('SAAS_API_URL') . '/api/v2/books/' . $request->id;

        // send delete request to API
        $response = Http::withToken(session('token_key'))->delete($apiURL);

        $statusCode = $response->status();

        if ($statusCode == 204) {
            $messages['success'][] = 'Book with id: ' . $request->id . ' deleted successfully.';
            // Send message.
            return back()->with('messages', $messages);
        }
        $messages['error'][] = 'Something went wrong.';
        // Send message.
        return back()->with('messages', $messages);
    }
}
