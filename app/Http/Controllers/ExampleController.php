<?php

namespace App\Http\Controllers;

use App\Models\Example;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        // $examples = Example::all();
        $examples = Example::with('children')->get();

        $this->responseMessage = 'Example List';
        $this->responseData = $examples;
        $this->responseCodeName = self::CODENAME_SUCCEED;
        $this->responseHttpStatusCode = self::HTTP_STATUS_CODE_OK;

        return $this->response();
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $example = Example::create([
          'name' => $input['name'],
        ]);

        $this->responseMessage = 'Example Created';
        $this->responseData = $example;
        $this->responseCodeName = self::CODENAME_CREATED;
        $this->responseHttpStatusCode = self::HTTP_STATUS_CODE_CREATED;

        return $this->response();
    }

    public function show(Request $request, $example)
    {
        $this->responseMessage = 'Example Detail';
        $this->responseData = $request->get('example');
        $this->responseCodeName = self::CODENAME_SUCCEED;
        $this->responseHttpStatusCode = self::HTTP_STATUS_CODE_OK;

        return $this->response();
    }

    public function update(Request $request, $example)
    {
        $input = $request->all();
        $example = $request->get('example');
        $example->name = $input['name'];
        $example->save();

        $this->responseMessage = 'Example Updated';
        $this->responseData = $example;
        $this->responseCodeName = self::CODENAME_SUCCEED;
        $this->responseHttpStatusCode = self::HTTP_STATUS_CODE_OK;

        return $this->response();
    }

    public function destroy(Request $request, $example)
    {
        $example = $request->get('example');
        $example->delete();

        $this->responseMessage = 'Example Deleted';
        $this->responseCodeName = self::CODENAME_SUCCEED;
        $this->responseHttpStatusCode = self::HTTP_STATUS_CODE_OK;

        return $this->response();
    }

    public function search(Request $request, $keyword)
    {
        $examples = Example::where('name', 'like', "%{$keyword}%")->get();

        $this->responseMessage = 'Search Result';
        $this->responseData = $examples;
        $this->responseCodeName = self::CODENAME_SUCCEED;
        $this->responseHttpStatusCode = self::HTTP_STATUS_CODE_OK;

        return $this->response();
    }
}
