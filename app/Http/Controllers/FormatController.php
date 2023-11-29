<?php

namespace App\Http\Controllers;

class FormatController extends Controller
{
    /**
     * @param string $method = login function name
     * @param array $parameters = laravel basement value
     */
    public function callAction($method, $parameters)
    {
        $response = parent::callAction($method, $parameters);

        return response()->json([
            'status' => 'success',
            'message' => !isset($response) ? (object)[] : $response,
        ]);
    }
}
