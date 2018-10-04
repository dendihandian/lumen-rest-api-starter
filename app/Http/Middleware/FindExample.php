<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Example;

class FindExample
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
        // get id from url parameter
        $exampleId = $request->route()[2]['example'];

        // find example
        $example = Example::find($exampleId);

        // check if the example not found
        if (!$example) {

            // prepare response
            $response = [
              'message' => 'Example not found',
              'id' => (int) $exampleId,
            ];

            return response()->json($response, 404);
        }

        // add example to request attributes (pass example to the controller)
        $request->attributes->add(['example' => $example]);

        return $next($request);
    }
}
