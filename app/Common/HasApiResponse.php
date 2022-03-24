<?php 

namespace App\Common;

use Symfony\Component\HttpFoundation\Response;

trait HasApiResponse
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function httpCreated(string $message)
    {
    	$response = [
            'success' => true,
            'message' => $message,
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function httpInternalServerError(string $message)
    {
    	$response = [
            'success' => false,
            'message' => $message,
        ];

        return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
    }
   
}