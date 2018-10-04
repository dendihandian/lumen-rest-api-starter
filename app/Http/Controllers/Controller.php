<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    const HTTP_STATUS_CODE_OK = 200;
    const HTTP_STATUS_CODE_CREATED = 201;

    const CODENAME_SUCCEED = 'Succeed';
    const CODENAME_CREATED = 'Created';
    const CODENAME_UPDATED = 'Updated';
    const CODENAME_DELETED = 'Deleted';

    const CODENAME_BAD_REQUEST = 'BadRequest';
    const CODENAME_VALIDATION_ERROR = 'ValidationError';
    const CODENAME_INTERNAL_SERVER_ERROR = 'InternalServerError';

    protected $responseId = null;
    protected $responseMessage = null;
    protected $responseCodeName = null;
    protected $responseData = null;
    protected $responseHttpStatusCode = 200;

    protected function response()
    {
        return response()->json([
            'id' => $this->responseId,
            'message' => $this->responseMessage,
            'code' => $this->responseCodeName,
            'data' => $this->responseData
        ], $this->responseHttpStatusCode);
    }
}
