<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;

class Api
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        
        // Можно сделать проверку ключа для "авторизации"
        //само значение APIKEY по хорошему перенести в .env файл, но здесь для примера
        if ($request->header('APIKEY') !== "FIN-RA") {
            throw new HttpResponseException(response()->json([
                'status' => 'error',
                'message' => 'invalid apikey in header'
            ], 401));
        }


        return $next($request);
    }
}