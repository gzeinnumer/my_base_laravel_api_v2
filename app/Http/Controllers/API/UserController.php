<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    //localhost:8000/api/user/find/{{id}}
    public function find($id)
    {
        try {
            $result = User::find($id);

            $ar = $this->getApiRespsonse(1);

            return $this->initResponse(1, $ar->title, $ar->message, $result == null ? 0 : 1, null, null, null, null, $result, []);
        } catch (\Throwable $th) {
            $ar = $this->getApiResponse(-1);
            return $this->initResponse(-1, $ar->title, $th->getMessage(), null, null, null, null, null, null, []);
        }
    }

    //localhost:8000/api/user/all
    public function all()
    {
        try {
            $result = User::all();
            $ar = $this->getApiResponse(1);
            return $this->initResponse(1,  $ar->title, $ar->message, count($result), null, null, null, null, null, $result);
        } catch (\Throwable $th) {
            $ar = $this->getApiResponse(-1);
            return $this->initResponse(-1, $ar->title, $th->getMessage(), null, null, null, null, null, null, []);
        }
    }
    //localhost:8000/api/user/paging?limit=10&page=1&start_date=2023-01-01&end_date=2023-01-01
    public function paging(Request $r)
    {
        try {
            $limit = $r->limit ? $r->limit : 10;
            $page = $r->page ? $r->page : 1;
            $start_date = $r->start_date;
            $end_date = $r->end_date;

            $query = User::select();

            if ($start_date) {
                $query = $query->whereDate('created_at', '>=', $start_date)
                    ->whereDate('created_at', '<=', $end_date);
            }

            $dataParsing = $query;
            $result = $dataParsing->paginate($limit, ['*'], 'page', $page)->items();
            $info = $this->generateInfoPagination($dataParsing, $limit, $page);

            $ar = $this->getApiResponse(1);

            return $this->initResponse(1, $ar->title, $ar->message, $info->total, $info->totalPage, $info->page, $info->next, $info->prev, null, $result);
        } catch (\Throwable $th) {
            $ar = $this->getApiResponse(-1);
            return $this->initResponse(-1, $ar->title, $th->getMessage(), null, null, null, null, null, null, []);
        }
    }

    /*
    {
        "name" : "data 1"
    }
    */
    //localhost:8000/api/user/insert
    public function insert(Request $r)
    {
        try {
            $input = array(
                'name' => 'required|string|min:1'
            );

            $validator = Validator::make($r->all(), $input);

            if ($validator->fails()) {
                $apiResponse = $this->getApiResponse(0);
                $apiResponse->message = $validator->getMessageBag();
                return $this->responseFailed($apiResponse);
            }

            DB::beginTransaction();

            $result = new User();
            foreach ($r->all() as $key => $value) {
                $result->$key = $value;
            }
            $result->save();

            DB::commit();

            $apiResponse = $this->getApiResponse(1);
            return $this->responseSuccess($apiResponse);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseError($th);
        }
    }

    /*
    {
        "name" : "Data 1 Update"
    }
    */
    //localhost:8000/api/user/update/{{id}}
    public function update(Request $r, $id)
    {
        try {
            $input = array(
                'name' => 'required|string|min:1'
            );

            $validator = Validator::make($r->all(), $input);

            if ($validator->fails()) {
                $apiResponse = $this->getApiResponse(0);
                $apiResponse->message = $validator->getMessageBag();
                return $this->responseFailed($apiResponse);
            }

            DB::beginTransaction();

            $result = User::find($id);
            foreach ($r->all() as $key => $value) {
                $result->$key = $value;
            }
            $result->save();

            DB::commit();

            $apiResponse = $this->getApiResponse(1);
            return $this->responseSuccess($apiResponse);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseError($th);
        }
    }

    //localhost:8000/api/user/delete/{{id}}
    public function delete($id)
    {
        try {
            $result = User::find($id);

            DB::beginTransaction();

            $result->delete();

            DB::commit();

            $apiResponse = $this->getApiResponse(1);
            return $this->responseSuccess($apiResponse);
        } catch (\Throwable $th) {
            return $this->responseError($th);
        }
    }
}
