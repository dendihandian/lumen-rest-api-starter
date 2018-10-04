<?php

namespace App\Http\Controllers;

use App\Models\Example;
use App\Models\ExampleChildren;
use Illuminate\Http\Request;

class ExampleChildrenController extends Controller
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

    public function index(Request $request, $example)
    {
        $exampleChildren = ExampleChildren::where('parent_id', $example)->get();

        $this->responseMessage = 'Example Children List';
        $this->responseData = $exampleChildren;
        $this->responseCodeName = self::CODENAME_SUCCEED;
        $this->responseHttpStatusCode = self::HTTP_STATUS_CODE_OK;

        return $this->response();
    }

    public function store(Request $request, $example)
    {
        $input = $request->all();

        $exampleChild = ExampleChildren::create([
          'parent_id' => $example,
          'name' => $input['name'],
        ]);

        $this->responseMessage = 'Example Child Created';
        $this->responseData = $exampleChild;
        $this->responseCodeName = self::CODENAME_CREATED;
        $this->responseHttpStatusCode = self::HTTP_STATUS_CODE_CREATED;

        return $this->response();
    }

    public function show(Request $request, $example, $child)
    {
        $this->responseMessage = 'Example Children Detail';
        $this->responseData = $request->get('exampleChild');
        $this->responseCodeName = self::CODENAME_SUCCEED;
        $this->responseHttpStatusCode = self::HTTP_STATUS_CODE_OK;

        return $this->response();
    }

    public function update(Request $request, $example, $child)
    {
        $input = $request->all();
        $exampleChild = $request->get('exampleChild');
        $exampleChild->parent_id = $example;
        $exampleChild->name = $input['name'];
        $exampleChild->save();

        $this->responseMessage = 'Example Child Updated';
        $this->responseData = $exampleChild;
        $this->responseCodeName = self::CODENAME_SUCCEED;
        $this->responseHttpStatusCode = self::HTTP_STATUS_CODE_OK;

        return $this->response();
    }

    public function destroy(Request $request, $example, $child)
    {
        $exampleChild = $request->get('exampleChild');
        $exampleChild->delete();

        $this->responseMessage = 'Example Child Deleted';
        $this->responseCodeName = self::CODENAME_SUCCEED;
        $this->responseHttpStatusCode = self::HTTP_STATUS_CODE_OK;

        return $this->response();
    }
}
