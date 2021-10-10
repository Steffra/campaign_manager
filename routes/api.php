<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProductController;

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

Route::get('campaigns',[CampaignController::class, 'index']);
Route::get('campaign/{campaign}',[CampaignController::class, 'show']);
Route::post('activateCampaign/{campaign}',[CampaignController::class, 'activate']);
Route::post('inactivateCampaign/{campaign}',[CampaignController::class, 'inactivate']);
Route::post('approveCampaign/{campaign}',[CampaignController::class, 'approve']);
Route::post('disapproveCampaign/{campaign}',[CampaignController::class, 'disapprove']);


Route::get('posts',[PostController::class, 'index']);
Route::get('post/{post}',[PostController::class, 'show']);
Route::post('publicatePost/{post}',[PostController::class, 'publicate']);

Route::get('coupons',[CouponController::class, 'index']);
Route::get('coupon/{coupon}',[CouponController::class, 'show']);
Route::post('activateCoupon/{coupon}',[CouponController::class, 'activate']);

Route::get('products',[ProductController::class, 'index']);
Route::get('product/{product}',[ProductController::class, 'show']);
Route::post('publicateProduct/{product}',[ProductController::class, 'publicate']);
