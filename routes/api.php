<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/search_record', 'API\ApiController@search_record');
});
Route::post('/updateQmsStatus', 'API\ApiController@updateQmsStatus');
Route::post('/sapData', 'API\ApiController@sapData');
Route::post('/sapDataToMortgage', 'API\ApiController@sapDataToMortgage');
Route::post('/sapDataWarranty', 'API\ApiController@sapDataWarranty');
Route::post('/campaigns', 'API\ApiController@campaigns');
Route::post('/searchRecords', 'API\ApiController@searchRecords');
Route::get('/projects', 'API\ApiController@projects');
Route::get('/updateReocrId', 'API\ApiController@updateReocrId');
Route::get('/test', 'API\ApiController@test');
Route::get('/qa_records', 'API\ApiController@qa_records');
Route::get('/changeStatusClient', 'API\ApiController@changeStatusClient');
Route::get('/select_electric', 'API\ApiController@select_electric');
Route::get('/selectClient', 'API\ApiController@selectClient');
Route::get('/get-campaigns', 'API\ApiController@getCampaigns');
Route::get('/get-projects', 'API\ApiController@getProjects');
Route::get('/get-clients', 'API\ApiController@getClients');
