<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use stdClass;

class BaseController extends Controller
{
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

    public function initResponse($status, $title, $message, $total, $totalPage, $page, $next, $prev, $data, $datas)
    {
        // $apiRespoonse = $this->getApiResponse($code);
        $res = new stdClass;
        $res->status = $status;
        $res->title = $title;
        $res->message = $message;
        $info = new stdClass;
        $info->total = $total;
        $info->totalPage = $totalPage;
        $info->page = $page;
        $info->next = $next;
        $info->prev = $prev;
        $res->info = $info;
        $res->data = $data;
        $res->datas = $datas;
        return $res;
    }

    public function generateInfoPagination($dataParsing, $limit, $page)
    {
        $total = $dataParsing->paginate()->total();
        $totalPage = $this->initParams($total, $limit);
        $next = $page + 1;
        $prev = $page - 1;

        $info = new stdClass();
        $info->total = $total;
        $info->totalPage = $totalPage;
        $info->page = (int) $page;

        if (
            $page > $totalPage || $page <= 0
        ) {
            $info->next = null;
            $info->prev = null;

            return $info;
        } else {
            $info->next = $page == $totalPage ? null : $next;
            $info->prev = $prev == 0 ? null : $prev;

            return $info;
        }
    }

    protected function initParams($total, $limit)
    {
        $totalPage = $total / $limit;
        $isMore = $totalPage > (int) $totalPage;
        return (int) $totalPage + ($isMore ? 1 : 0);
    }
}
