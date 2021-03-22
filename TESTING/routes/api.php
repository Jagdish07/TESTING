<?php

use Illuminate\Http\Request;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['namespace' => 'Api'], function(){

	Route::group(['namespace' => 'v1'], function(){
		Route::post('auth/termsConditions','AuthController@termsConditions');
		Route::post('auth/privacyPolicy','AuthController@privacyPolicy');
		Route::post('auth/register','AuthController@register');
		Route::post('auth/login','AuthController@login');
		Route::post('auth/forgotPassword','AuthController@forgotPassword');

//		Route::post('auth/getAllState','AuthController@getAllState');
		Route::post('auth/getAllBrands','AuthController@getAllBrands');
		Route::post('auth/getAllCity','AuthController@getAllCity');
		Route::post('auth/getAllState','AuthController@getAllState');
		Route::post('auth/getAllLocations','AuthController@getAlllocation');

		Route::get('/giftCardExcel','VoucherController@giftRedemed');
		Route::get('/salesApproved','VoucherController@salesApproved');

		Route::middleware('APIToken')->group(function () {
			Route::post('auth/changePassword','AuthController@changePassword');
			Route::post('auth/editProfile','AuthController@editProfile');
			Route::post('auth/getProfile','AuthController@getProfile');
			Route::post('campaign/getLocationCampaigns','CampaignsController@getLocationCampaigns');
			Route::post('campaign/getCampaignDetail','CampaignsController@getCampaignDetail');
			Route::post('campaign/claimCampaignPoints','CampaignsController@claimCampaignPoints');
			Route::get('support/getTitle','SupportController@getSupportQuestions');
			Route::post('support/generateTicket','SupportController@saveSupport');
			Route::post('voucher/insertVoucher','VoucherController@insertVoucher');
			Route::get('voucher/getVoucherList','VoucherController@getGiftCard');
			Route::post('voucher/redeem','VoucherController@voucherReedem');
			Route::get('mySpace','AuthController@myspace');
			Route::get('auth/logout','AuthController@logout');
			Route::get('auth/terminateAccount','AuthController@deleteAccount');
		});
	});
});
