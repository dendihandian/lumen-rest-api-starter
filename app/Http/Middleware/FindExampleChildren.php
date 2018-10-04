<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ExampleChildren;

class FindExampleChildren
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
        $exampleChildId = $request->route()[2]['child'];

        // find example
        $exampleChild = ExampleChildren::find($exampleChildId);

        // check if the example child not found
        if (!$exampleChild) {

            // prepare response
            $response = [
              'message' => 'Example Children Not Found',
              'id' => (int) $exampleChildId,
            ];

            return response()->json($response, 404);
        }

        // add example to request attributes (pass example to the controller)
        $request->attributes->add(['exampleChild' => $exampleChild]);

        return $next($request);
    }
}
