<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Validator;

class BooksController extends Controller
{
    /**
    * create new book.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        // check user logs
        if (!session('token_key')) {
            return redirect('/');
        }
        // get API base url from .env file
        $apiURL = getenv('SAAS_API_URL') . '/api/v2/authors?orderBy=id&direction=ASC&limit=100000000&page=1';

        $response = Http::withToken(session('token_key'))->get($apiURL);

        $statusCode = $response->status();

        $responseBody = json_decode($response->getBody(), true);

        return view('createBook', ['authors'=> $responseBody]);
    }

    /**
     * Store new book.
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        // check user logs
        if (!session('token_key')) {
            return redirect('/');
        }

        // Validate inputs.
        $validator = Validator::make($request->all(), [
            'author' => ['required', 'int'],
            'title' => ['required', 'string', 'max:255'],
            'release_date' => ['required', 'date'],
            'isbn' => ['required', 'string', 'max:255'],
            'format' => ['required', 'string', 'max:255'],
            'number_of_pages' => ['required', 'int'],
            'description' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            $messages = [];
            foreach ($validator->errors()->all() as $error) {
                $messages['error'][] = $error;
            }
            // Send message if received invalid data.
            return back()->with('status', $messages);
        }

        // get API base url from .env file
        $apiURL = getenv('SAAS_API_URL') . '/api/v2/books';

        $postInput = [
            'author' => ['id'=> intval($request->author)],
            'title' => $request->title,
            'release_date' => $request->release_date,
            'isbn' => $request->isbn,
            'format' => $request->format,
            'number_of_pages' => intval($request->number_of_pages),
            'description' => $request->description,
        ];

        // send the post request to API
        $response = Http::withToken(session('token_key'))->post($apiURL, $postInput);

        $statusCode = $response->status();

        // check API response status
        if ($statusCode == 200) {
            $messages['success'][] = 'Book created successfully.';
            // Send message.
            return back()->with('messages', $messages);
        }
        $messages['error'][] = 'Something went wrong.';
        // Send message.
        return back()->with('messages', $messages);
    }


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
