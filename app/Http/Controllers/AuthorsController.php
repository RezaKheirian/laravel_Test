<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthorsController extends Controller
{
    /**
     * Display a listing of authors.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // check user logs
        if (!session('token_key')) {
            return redirect('/');
        }

        // get API base url from .env file
        $apiURL = getenv('SAAS_API_URL') . '/api/v2/authors';

        // check the GET params
        $getInput = [
            'query' => isset($_GET['query']) ? $_GET['query'] : '',
            'orderBy' => (isset($_GET['orderBy']) and in_array($_GET['orderBy'], ['first_name', 'last_name', 'birthday', 'gender', 'place_of_birth'])) ? $_GET['orderBy'] : 'id',
            'direction' => (isset($_GET['direction']) and (strtolower($_GET['direction']) == 'desc')) ? 'DESC' : 'ASC',
            'limit' => isset($_GET['limit']) ? intval($_GET['limit']) : 12,
            'page' => isset($_GET['page']) ? intval($_GET['page']) : 1
        ];

        $response = Http::withToken(session('token_key'))->get($apiURL, $getInput);

        $statusCode = $response->status();

        $responseBody = json_decode($response->getBody(), true);


        if ($statusCode == 200) {
            // create pagination urls
            $pagination = [];
            if ($responseBody[ 'total_pages' ] > 0) {
                $getValue = $_GET;
                $pagination = [
                    'previous_page' => '',
                    'next_page' => ''
                ];

                if ($responseBody[ 'current_page' ] > 1) {
                    $getValue['page'] = $responseBody[ 'current_page' ]-1;
                    $pagination['previous_page'] = 'authors?' . http_build_query($getValue);
                }
                if ($responseBody[ 'current_page' ] < $responseBody[ 'total_pages' ]) {
                    $getValue['page'] = $responseBody[ 'current_page' ]+1;
                    $pagination['next_page'] = 'authors?' . http_build_query($getValue);
                }
            }
            return view('authors', ['authors'=>$responseBody, 'pagination'=>$pagination]);
        } else {
            $messages['error'][] = 'Something went wrong.';
            // Send message.
            return redirect('/')->with('messages', $messages);
        }
    }


    /**
     * Display an author detail and books.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function detail(Request $request)
    {
        // check user logs
        if (!session('token_key')) {
            return redirect('/');
        }

        // get API base url from .env file
        $apiURL = getenv('SAAS_API_URL') . '/api/v2/authors/' . $request->id;

        $response = Http::withToken(session('token_key'))->get($apiURL);

        $statusCode = $response->status();

        $responseBody = json_decode($response->getBody(), true);
        if ($statusCode == 200) {
            return view('author', ['author'=>$responseBody]);
        } else {
            $messages['error'][] = 'Something went wrong.';
            // Send message.
            return redirect('/authors')->with('messages', $messages);
        }
    }

     /**
     * Delete an author.
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
        $apiURL = getenv('SAAS_API_URL') . '/api/v2/authors/' . $request->id;

        // send delete request to API
        $response = Http::withToken(session('token_key'))->delete($apiURL);

        $statusCode = $response->status();

        if ($statusCode == 204) {
            $messages['success'][] = 'Author with id: ' . $request->id . ' deleted successfully.';
            // Send message.
            return redirect('/authors')->with('messages', $messages);
        }
        $messages['error'][] = 'Something went wrong.';
        // Send message.
        return redirect('/authors')->with('messages', $messages);
    }
}
