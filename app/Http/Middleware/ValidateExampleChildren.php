<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Example;

class ValidateExampleChildren
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // get all parameters
        $input = $request->all();

        // validate example
        $rules = [
          'name' => 'required|string|min:3|max:255',
        ];

        $validator = \Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json([
              'message' => 'Validation Error',
              'code' => 'ValidationError',
              'data' => $validator->errors()
            ], 400);
        }

        return $next($request);
    }
}
