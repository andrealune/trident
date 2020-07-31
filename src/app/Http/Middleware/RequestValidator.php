<?php

namespace App\Http\Middleware;

use Closure;

class RequestValidator
{

    private $requestNamespace = '\\App\\Http\\Requests\\';
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $class, $method)
    {
        $validator = app('validator')->make(
            $request->input(), 
            app($this->requestNamespace . $class)->$method($request)
        );

        if ($validator->fails()) {
            return $this->response($request, $validator->errors());
        }

        return $next($request);
    }

    protected function response($request, $errors)
    {
        return response()->json($errors, 422);
    }
}
