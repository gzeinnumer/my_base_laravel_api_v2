<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MApiResponseModel;
use stdClass;

class BaseControllerSetting extends Controller
{
    protected $page = 1;
    protected $limit = 10;

    // public function getApiResponse($code) {
    //     $apiResponse = MApiResponseModel::select('title','message')
    //                         ->where(['response_number'=>$code])
    //                         ->first();
    //     return $apiResponse;
    // }

    public function getApiResponse($code)
    {
        $apiResponse = new stdClass();
        $apiResponse->title = "Perhatian";
        // $apiResponse->message = "pesan";
        if ($code == 1) {
            $apiResponse->message = "Success";
        } else if ($code == 0) {
            $apiResponse->message = "Failed";
        } else if ($code == -1) {
            $apiResponse->message = "Error";
        }

        return $apiResponse;
    }

    protected function initResponse($status, $title, $message, $data, $info)
    {
        $result = new stdClass();
        $result->status = $status;
        $result->title = $title;
        $result->message = $message;
        if ($info != null) {
            $result->info = $info;
        }
        if ($data != null) {
            $result->data = $data;
        }
        return $result;
    }

    protected function responseList($apiResponse, $result, $info)
    {
        $status = $info->total > 0 ? 1 : 0;
        $response = $this->initResponse(
            $status,
            $apiResponse->title,
            $apiResponse->message,
            $result,
            $info
        );
        return response()->json($response, 200);
    }

    protected function responseSingle($apiResponse, $result)
    {
        $info = new stdClass();
        $info->total = 1;
        // $info->totalPage = null;
        // $info->page = null;
        // $info->next = null;
        // $info->prev = null;

        $response = $this->initResponse(
            1, //status
            $apiResponse->title, //title
            $apiResponse->message, //message
            $result, //data
            $info //info
        );
        return response()->json($response, 200);
    }

    protected function responseSuccess($apiResponse)
    {
        $response = $this->initResponse(
            1, //status
            $apiResponse->title, //title
            $apiResponse->message, //message
            null, //data
            null //info
        );
        return response()->json($response, 200);
    }

    public function responseFailed($apiResponse)
    {
        $response = $this->initResponse(
            0, //status
            $apiResponse->title, //title
            $apiResponse->message, //message
            null, //data
            null, //info
        );
        return response()->json($response, 200);
    }

    public function responseError($th)
    {
        $apiResponse = $this->getApiResponse(-1);
        $apiResponse->message = $th->getMessage();

        $response = $this->initResponse(
            -1, //status
            $apiResponse->title, //title
            $apiResponse->message, //message
            null, //data
            null, //info
        );
        return response()->json($response, 500);
    }

    public function finalResultList($isSuccess, $codeSuccess, $codeFailed, $result, $info)
    {
        if ($isSuccess) {
            $apiResponse = $this->getApiResponse($codeSuccess);
            return $this->responseList($apiResponse, $result, $info);
        } else {
            $apiResponse = $this->getApiResponse($codeFailed);
            return $this->responseFailed($apiResponse);
        }
    }

    public function finalResultSingle($total, $codeSuccess, $codeFailed, $result)
    {
        if ($total > 0) {
            $apiResponse = $this->getApiResponse($codeSuccess);
            return $this->responseSingle($apiResponse, $result);
        } else {
            $apiResponse = $this->getApiResponse($codeFailed);
            return $this->responseFailed($apiResponse);
        }
    }

    public function finalResultPaging($codeSuccess, $result, $info)
    {
        $apiResponse = $this->getApiResponse($codeSuccess);
        return $this->responseList($apiResponse, $result, $info);
    }
}