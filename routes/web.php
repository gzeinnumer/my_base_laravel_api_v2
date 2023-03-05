<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $data = [];
    $data[] = [
        'url' => 'api/user/all',
        'request' => '-',
        'response' => '{
    "status": 1,
    "title": "Perhatian",
    "message": "Success",
    "info": {
        "total": 1,
        "totalPage": null,
        "page": null,
        "next": null,
        "prev": null
    },
    "data": null,
    "datas": [
        {
            "id": 1,
            "name": "Prof. Fern Kub",
            "email": "myles.schneider@example.com",
            "email_verified_at": "2023-03-05T05:43:14.000000Z",
            "created_at": "2023-03-05T05:43:15.000000Z",
            "updated_at": "2023-03-05T05:43:15.000000Z"
        }
    ]
}'
    ];
    $data[] = [
        'url' => 'api/user/find/1',
        'request' => '-',
        'response' => '{
    "status": 1,
    "title": "Perhatian",
    "message": "Success",
    "info": {
        "total": 1,
        "totalPage": null,
        "page": null,
        "next": null,
        "prev": null
    },
    "data": {
        "id": 1,
        "name": "Prof. Fern Kub",
        "email": "myles.schneider@example.com",
        "email_verified_at": "2023-03-05T05:43:14.000000Z",
        "created_at": "2023-03-05T05:43:15.000000Z",
        "updated_at": "2023-03-05T05:43:15.000000Z"
    },
    "datas": []
}'
    ];
    $data[] = [
        'url' => 'api/user/paging?limit=10&page=1&start_date=2023-01-01&end_date=2023-01-01',
        'request' => '-',
        'response' => '{
    "status": 1,
    "title": "Perhatian",
    "message": "Success",
    "info": {
        "total": 10000,
        "totalPage": 1000,
        "page": 1,
        "next": 2,
        "prev": null
    },
    "data": null,
    "datas": [
        {
            "id": 1,
            "name": "Prof. Fern Kub",
            "email": "myles.schneider@example.com",
            "email_verified_at": "2023-03-05T05:43:14.000000Z",
            "created_at": "2023-03-05T05:43:15.000000Z",
            "updated_at": "2023-03-05T05:43:15.000000Z"
        }
    ]
}'
    ];
    $data[] = [
        'url' => 'api/user/insert',
        'request' => '{
    "name" : "zein1",
    "email" : "zein1@zein.com",
    "password" : "12345678"
}',
        'response' => '{
    "status": 1,
    "title": "Perhatian",
    "message": "Success",
    "info": {
        "total": null,
        "totalPage": null,
        "page": null,
        "next": null,
        "prev": null
    },
    "data": null,
    "datas": []]
}'
    ];
    $data[] = [
        'url' => 'api/user/update/1001',
        'request' => '{
    "name" : "zein2",
    "email" : "zein2@zein.com",
    "password" : "12345678"
}',
        'response' => '{
    "status": 1,
    "title": "Perhatian",
    "message": "Success",
    "info": {
        "total": null,
        "totalPage": null,
        "page": null,
        "next": null,
        "prev": null
    },
    "data": null,
    "datas": []
}'
    ];
    $data[] = [
        'url' => 'api/user/delete/1001',
        'request' => '',
        'response' => '{
    "status": 1,
    "title": "Perhatian",
    "message": "Success",
    "info": {
        "total": null,
        "totalPage": null,
        "page": null,
        "next": null,
        "prev": null
    },
    "data": null,
    "datas": []
}'
    ];
    return view('welcome', ['data' => $data]);
});
