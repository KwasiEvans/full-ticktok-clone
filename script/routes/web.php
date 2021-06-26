<?php

use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Installer Routes
|--------------------------------------------------------------------------
|
| All installer routes is here
| 
|
*/

Route::group(['namespace'=>'Installer'],function(){
	Route::get('install','InstallerController@index')->name('install');
	Route::get('install/configuration','InstallerController@configuration')->name('install.configuration');
	Route::get('install/verify','InstallerController@verify')->name('install.verify');
	Route::post('verify_check','InstallerController@verify_check')->name('install.verify_check');
	Route::get('install/complete','InstallerController@complete')->name('install.complete');
	Route::post('install/store','InstallerController@send')->name('install.store');
	Route::get('install/check','InstallerController@check')->name('install.check');
	Route::get('install/migrate','InstallerController@migrate')->name('install.migrate');
	Route::get('install/seed','InstallerController@seed')->name('install.seed');
	Route::get('404',function(){
		return abort(404);
	})->name(404);
});


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

// Multi Language Controller
Route::get('/locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
})->name('lang.set')->middleware('two_factor');

// welcome route for home page
Route::get('/','WelcomeController@index')->name('welcome')->middleware('two_factor');

// profile route for show user profile
Route::get('/user/{slug}','UserController@show')->name('profile.show')->middleware('two_factor');

// popup routes 
Route::get('/popup','PopupController@popup')->name('popup')->middleware('two_factor');

// ads routes
Route::get('/ads_show','PopupController@ads')->name('ads.show')->middleware('two_factor');
Route::get('/ads/redirect/{ads_id}/{user_id}','PopupController@ads_redirect')->name('ads.redirect')->middleware('two_factor');

// ellipsis model routes
Route::get('ellipsis','EllipsisController@ellipsis')->name('ellipsis')->middleware('two_factor');

// video show routes
Route::get('video/{slug}','VideoController@show')->name('video.show')->middleware('two_factor');

// larest,trending,most popular video show routes
Route::get('trending','VideoController@trending')->name('trending')->middleware('two_factor');
Route::get('latest','VideoController@latest')->name('latest')->middleware('two_factor');
Route::get('popular','VideoController@popular')->name('popular')->middleware('two_factor');

// search routes
Route::get('search','SearchController@search')->name('search');

// night and day mode route
Route::get('mode','ModeController@mode')->name('mode');

// logo change route
Route::get('logo_change','ModeController@logo_change')->name('logo_change')->middleware('two_factor');

// create payment route
Route::post('create-payment','AdvertisingController@payment')->middleware('two_factor');

// page route
Route::get('page/{slug}','PageController@show')->name('page.show')->middleware('two_factor');

// two step routes
Route::get('two/step','TwostepController@index')->name('two.step')->middleware('auth');
Route::post('two/step/verify','TwostepController@verify')->name('two.step.verify')->middleware('auth');
Route::get('two/step/notify','TwostepController@notify')->name('two.step.notify')->middleware('auth');

// logout route
Route::get('logout','WelcomeController@logout')->name('user.logout')->middleware('auth');

// laravel default auth routes
Auth::routes(['verify' => true]);

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| All installer routes is here
| 
|
*/

Route::group(['middleware'=>['auth','two_factor']],function(){
	Route::get('follow/{id}','FollowController@follow')->name('follow');
	Route::get('unfollow/{id}','FollowController@unfollow')->name('unfollow');
	Route::get('upload','UploadController@index')->name('upload');
	Route::get('like','LikeController@like')->name('like');
	Route::get('comment_like','LikeController@comment_like')->name('comment_like');
	Route::post('comment','CommentController@store')->name('comment');
	Route::post('video/upload','UploadController@upload')->name('video.upload');
	Route::post('post/store','UploadController@store')->name('post.store');
	Route::get('edit/profile','SettingsController@edit')->name('profile.edit');
	Route::post('update/profile','SettingsController@update')->name('profile.update');
	Route::post('two/step','SettingsController@two_step')->name('profile.two_step');
	Route::post('account/delete','SettingsController@account_delete')->name('profile.delete');
	Route::get('profie/delete_session','SettingsController@delete_session')->name('profile.delete_session');
	Route::get('monetization/request','SettingsController@monetization_request')->name('monetization_request');
	Route::post('verification','VerificationController@store')->name('profile.verification');
	Route::get('settings','SettingsController@index')->name('settings');
	Route::post('settings/cover','SettingsController@cover')->name('settings.cover');
	Route::post('settings/profile','SettingsController@profile')->name('settings.profile');
	Route::get('ads','AdvertisingController@index')->name('ads.index');
	Route::get('ads/create','AdvertisingController@create')->name('ads.create');
	Route::post('ads','AdvertisingController@store')->name('ads.store');
	Route::post('ads/update/{id}','AdvertisingController@update')->name('ads.update');
	Route::get('ads/pending/{id}','AdvertisingController@pending')->name('ads.pending');
	Route::get('ads/approved/{id}','AdvertisingController@approved')->name('ads.approved');
	Route::get('ads/delete','AdvertisingController@delete')->name('ads.delete');
	Route::get('ads/edit/{id}','AdvertisingController@edit')->name('ads.edit');
	Route::get('users','UserController@find_users')->name('users');
	Route::post('withdraw','WithdrawController@store')->name('withdraw.store');
	Route::get('withdraw','WithdrawController@index')->name('withdraw.index');
	Route::post('report','ReportController@report')->name('report');
	Route::get('report/show','ReportController@show')->name('report.show');
	Route::get('report/user','ReportController@report_user')->name('user_report');
	Route::post('report/user','ReportController@report_user_store')->name('user_report');
});

Route::group(['middleware'=>['auth']],function(){
	Route::get('notification','NotificationController@notification')->name('notification');
	Route::get('notification_count','NotificationController@notification_count')->name('notification_count');
	Route::get('notification_unread','NotificationController@notification_unread')->name('notification_unread');
	Route::get('user/verification/request','UserController@verification')->name('user.verification');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| All routes for admin panel
|
*/

Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['admin','auth']],function(){
	Route::get('dashboard','DashboardController@index')->name('dashboard');
	Route::get('admin/logout','DashboardController@logout')->name('logout');
	Route::get('settings/general','Settings\GeneralController@index')->name('settings.general');
	Route::post('settings/general/update','Settings\GeneralController@update')->name('settings.general.update');
	Route::get('settings/sitesettings','Settings\SiteController@index')->name('settings.sitesettings');
	Route::post('settings/sitesettings/update','Settings\SiteController@update')->name('settings.sitesettings.update');
	Route::get('language/index','LanguageController@index')->name('language.index');
	Route::get('language/{id}/edit','LanguageController@edit')->name('language.edit');
	Route::get('language/create','LanguageController@create')->name('language.create');
	Route::post('language','LanguageController@store')->name('language.store');
	Route::post('language/update/{id}','LanguageController@update')->name('language.update');
	Route::get('language/delete/{code}','LanguageController@delete')->name('language.delete');
	Route::post('language/active','LanguageController@active')->name('language.active');
	Route::get('user/index','UserController@index')->name('user.index');
	Route::get('user/report','UserController@report')->name('user.report');
	Route::get('user/delete/{id}','UserController@delete')->name('user.delete');
	Route::get('video/index','VideoController@index')->name('video.index');
	Route::get('video/report','VideoController@report')->name('video.report');
	Route::get('video/report_delete/{id}','VideoController@report_delete')->name('video.report_delete');
	Route::post('video/view/{id}','VideoController@view')->name('video.view');
	Route::get('video/delete/{id}','VideoController@delete')->name('video.delete');
	Route::get('ads/index','AdsController@index')->name('ads.index');

	Route::get('ads/edit/{id}','AdsController@edit')->name('ads.edit');
	Route::post('ads/update/{id}','AdsController@update')->name('ads.update');

	Route::get('ads/delete/{id}','AdsController@delete')->name('ads.delete');
	Route::resource('sponsor','SponsorController');
	Route::get('sponsor/{id}/delete','SponsorController@destroy')->name('sponsor.delete');
	Route::resource('page','PageController');
	Route::get('page/{id}/delete','PageController@destroy')->name('page.delete');
	Route::get('user/verification','UserController@verification_request')->name('user.verification.request');
	Route::get('user/verify/{id}','UserController@verify')->name('user.verify');
	Route::get('user/verify/delete/{id}','UserController@verify_delete')->name('user.verify_delete');
	Route::get('user/monetization/request','MonetizationController@index')->name('monetization.index');
	Route::get('user/monetization/verify/{id}','MonetizationController@verify')->name('monetization.verify');
	Route::get('user/pending/request','UserController@pending_users')->name('user.pending');
	Route::get('user/pending/request/approved/{id}','UserController@approved')->name('user.approved');
	Route::get('user/monetization/delete/{id}','MonetizationController@delete')->name('monetization.delete');
	Route::get('user/withdraw/request','WithdrawController@index')->name('withdraw.index');
	Route::get('user/withdraw/accept/{id}','WithdrawController@accept')->name('withdraw.accept');
	Route::get('user/{user_id}/withdraw/reject/{withdraw_id}/','WithdrawController@reject')->name('withdraw.reject');
});


/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| All routes for users
|
*/

Route::group(['as'=>'user.','prefix'=>'user','namespace'=>'User','middleware'=>['user','auth']],function(){
	Route::get('profile','ProfileController@index')->name('profile');
});