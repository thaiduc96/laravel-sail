<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{

    private $allowedOriginsWhitelist = ['*', 'http://localhost:8082', 'http://localhost:8081','http://localhost:8080','http://baohanh.co','https://baohanh.co'];

    // All the headers must be a string

    private $allowedOrigin = '*';

    private $allowedMethods = 'OPTIONS, GET, POST, PUT, PATCH, DELETE';

    private $allowCredentials = 'true';

    private $allowedHeaders = 'Origin, Content-Type, Accept, Authorization, X-Request-With';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->allowedOrigin = $this->resolveAllowedOrigin($request);
        // REMOVE \Fruitcake\Cors\HandleCors::class, from middleware
//        header("Access-Control-Allow-Origin: *");
//        header("Access-Control-Allow-Origin: ".$this->allowedOrigin);
        //ALLOW OPTIONS METHOD
//        $headers = [
//            'Access-Control-Allow-Methods' => 'POST,GET,OPTIONS,PUT,PATCH,DELETE',
//            'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, Authorization',
//        ];

//        if ($request->getMethod() == "OPTIONS"){
//            //The client-side application can set only headers allowed in Access-Control-Allow-Headers
//            return response()->json('OK',200,$headers);
//        }
//        $response = $next($request);
//        foreach ($headers as $key => $value) {
//            $response->header($key, $value);
//        }
//        return $response;

//        $this->allowedHeaders = $this->resolveAllowedHeaders($request);

        $headers = [
            'Access-Control-Allow-Origin' => $this->allowedOrigin,
            'Access-Control-Allow-Methods' => $this->allowedMethods,
            'Access-Control-Allow-Headers' => $this->allowedHeaders,
            'Access-Control-Allow-Credentials' => $this->allowCredentials,
        ];

        // For preflighted requests
        if ($request->getMethod() === 'OPTIONS') {
            return response('OK', 200)->withHeaders($headers);
        }
        return $next($request)->withHeaders($headers);
    }

    /**
     * Dynamic resolution of allowed origin since we can't
     * pass multiple domains to the header. The appropriate
     * domain is set in the Access-Control-Allow-Origin header
     * only if it is present in the whitelist.
     *
     * @param \Illuminate\Http\Request $request
     */
    private function resolveAllowedOrigin($request)
    {
        $allowedOrigin = $this->allowedOrigin;

        // If origin is in our $allowedOriginsWhitelist
        // then we send that in Access-Control-Allow-Origin

        $origin = $request->headers->get('Origin');

        if (in_array($origin, $this->allowedOriginsWhitelist)) {
            $allowedOrigin = $origin;
        }

        return $allowedOrigin;
    }

    /**
     * Take the incoming client request headers
     * and return. Will be used to pass in Access-Control-Allow-Headers
     *
     * @param \Illuminate\Http\Request $request
     */
    private function resolveAllowedHeaders($request)
    {
        $allowedHeaders = $request->headers->get('Access-Control-Request-Headers');

        return $allowedHeaders;
    }
}
