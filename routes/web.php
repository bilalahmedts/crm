<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\DssController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeWarrantyController;
use App\Http\Controllers\Admin\CallAnalyticController;
use App\Http\Controllers\Admin\CMUSaleController;
use App\Http\Controllers\Admin\EddyController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HomeController; 

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

include( 'installer.php' );


Route::group(['namespace' => 'Frontend'], function () {
	Route::get('/', 'HomeController@index')->name('home');

	Route::get('/search', 'HomeController@searchResults')->name('search');

	Route::get('frequently-asked-questions', 'HomeController@faq')->name('faq');

	Route::get('knowledge-bases', 'HomeController@AllCategories')->name('knowledge_bases');

	Route::get('knowledge-bases/all-categories', 'HomeController@AllCategories')->name('kb.all-categories');

	Route::get('knowledge-bases/{category_id}-{category}', 'HomeController@KnowledgeBasesCategoryDetail')->name('kb.category_detail');

	Route::get('knowledge-bases/{category}/{sub_category_id}-{sub_category}', 'HomeController@KnowledgeBaseSubCategory')->name('kb.sub_category_detail');

	Route::get('knowledge-base/{article_id}-{article_name}', 'HomeController@KbArticleDetail')->name('kb.article-detail');

	Route::post('knowledge-base/{article}/update_helpful', 'HomeController@KbArticleUpdateHelpfull')->name('kb.update_helpful');

	Route::get('language/{locale}', 'HomeController@setLanguage')->name('front.set_language');

	// setLanguage

    // Route::get('/new-request', 'TicketController@createTicket')->name('ticket_new');

});


/**
 * Customer Panel
 */

Route::group(['namespace' => 'CustomerPanel', 'prefix'	 => 'customer'], function () {

	Route::group(['namespace' => 'Auth'], function () {
		// Customer Login
		Route::get('login', 'LoginController@show')->middleware('guest:customer')->name('customer.login');
		Route::get('register', 'RegisterController@show')
		    ->middleware('guest:customer')->name('customer.register');

	    Route::get('/password/forget-password', 'ForgotPasswordController@showLinkRequestForm')->middleware('guest:customer')->name('customer.forget_password');
	    Route::post('/password/forget-password', 'ForgotPasswordController@sendResetLinkEmail')->middleware('guest:customer')->name('customer.send_password');

		Route::get('/password/reset-password/{token}', 'ResetPasswordController@showResetForm')
		    ->middleware('guest:customer')->name('customer.password.reset');
	    Route::post('/password/reset-password','ResetPasswordController@reset')->name('customer.password.update');

		    // ResetPasswordController


		// Register & Login User
		Route::post('/do_login', 'LoginController@authenticate')->name('customer.do_login');
		Route::post('do_register', 'RegisterController@register')->name('customer.do_register');

	    Route::post('/logout', 'LoginController@logout')->name('customer.logout')->middleware('auth:customer');
	});

	// Protected Routes - allows only logged in users
	Route::middleware('auth:customer')->group(function () {

	    Route::get('/', 'TicketController@index')->name('customer.my-account');
	    Route::get('/tickets', 'TicketController@index')->name('customer.tickets');
	    Route::get('/tickets/{status}', 'TicketController@index')->name('customer.tickets.filter');

	    Route::get('new-ticket', 'TicketController@createTicket')->name('customer.ticket_new');
	    Route::post('new-ticket', 'TicketController@submitTicket')->name('customer.ticket_save');
	    Route::get('/tickets/view/{id}', 'TicketController@viewTicket')->name('customer.tickets_view');
	    Route::post('/tickets/{id}/reply', 'TicketController@replyTicket')->name('customer.ticket_reply');

    	Route::get('/tickets/{id}/status/{status}', 'TicketController@updateTicketStatus')->name('customer.ticket_update_status');


	    Route::post('account/profile-image', 'AccountController@updateProfileImage')->name('customer.profile_update_image');

	    Route::get('account/profile', 'AccountController@profile')->name('customer.profile');
	    Route::post('account/profile', 'AccountController@updateProfile')->name('customer.profile_update');

	    Route::get('account/profile-change-password', 'AccountController@changePassword')->name('customer.profile_change_password');
	    Route::post('account/profile-change-password', 'AccountController@updatePassword')->name('customer.profile_update_password');







	});

});

Route::group(['namespace' => 'Admin', 'prefix'	 => 'admin'], function () {

	Auth::routes([
		'register'	=>	false
	]);


	Route::group(['middleware' => 'auth:web'], function () {

		Route::get('/', 'HomeController@index');

		Route::get('/home', 'HomeController@index')->name('dashboard');

		Route::resource('users', 'UserController');
		Route::resource('customers', 'CustomerController');
		Route::resource('faqs', 'FaqController');
		Route::resource('faq-category', 'FaqCategoryController');
		Route::resource('knowledge_bases', 'KnowledgeBaseController');
		Route::resource('kb_categories', 'KbCategoryController');

		Route::get('canned_messages/show-json', ['as' => 'canned_messages.json_data', 'uses' => 'CannedMessageController@ajaxDetailData']);
		Route::resource('canned_messages', 'CannedMessageController');

		Route::get('kb_sub_categories/json-data/{parent}', ['as' => 'kb_sub_categories.json_data', 'uses' => 'KbSubCategoryController@ajaxData']);

		Route::resource('kb_sub_categories', 'KbSubCategoryController');
		Route::resource('departments', 'DepartmentController');
		Route::resource('designations', 'DesignationController');
		Route::resource('priorities', 'PriorityController');
		Route::resource('campaigns', 'CampaignController');
		Route::resource('clients', 'ClientController');


		
		Route::post('tickets/reply/{ticket}', ['as' => 'tickets.add_reply', 'uses' => 'TicketController@addReply']);
		Route::get('tickets/close-ticket/{ticket}', ['as' => 'tickets.close_ticket', 'uses' => 'TicketController@closeTicket']);
		Route::get('tickets/reopen-ticket/{ticket}', ['as' => 'tickets.reopen_ticket', 'uses' => 'TicketController@reOpenTicket']);
		Route::post('tickets/assign-user', ['as' => 'tickets.assign_user', 'uses' => 'TicketController@assignTicket']);

		Route::delete('tickets/destroy-multiple', ['as' => 'tickets.destroy_multiple', 'uses' => 'TicketController@destroyMultiple']);
		Route::resource('tickets', 'TicketController');

		Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
		Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
		Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

		Route::post('profile/upload-image', ['as' => 'profile.uplaod_image', 'uses' => 'ProfileController@uploadImage']);

		Route::resource('roles', 'RoleController');

		Route::group(['prefix' => 'settings'], function () {

			Route::get('general', ['as' => 'settings.general', 'uses' => 'SettingsController@general']);
			Route::post('general', ['as' => 'settings.general.store', 'uses' => 'SettingsController@generalStore']);
			Route::post('general/socialmedia', ['as' => 'settings.general.store_social_media', 'uses' => 'SettingsController@generalSocialMediaStore']);

			Route::get('language', ['as' => 'settings.language', 'uses' => 'SettingsController@language']);
			Route::post('language', ['as' => 'settings.language.store', 'uses' => 'SettingsController@languageStore']);

			Route::get('api', ['as' => 'settings.api', 'uses' => 'SettingsController@api']);
			Route::post('api', ['as' => 'settings.api.store', 'uses' => 'SettingsController@apiStore']);

			Route::get('frontend', ['as' => 'settings.frontend', 'uses' => 'SettingsController@frontend']);
			Route::post('frontend', ['as' => 'settings.frontend.store', 'uses' => 'SettingsController@frontendStore']);
			Route::post('frontend/homepage', ['as' => 'settings.frontend.home.store', 'uses' => 'SettingsController@frontendHomeStore']);

			Route::get('ticket', ['as' => 'settings.ticket', 'uses' => 'SettingsController@ticket']);
			Route::post('ticket', ['as' => 'settings.ticket.store', 'uses' => 'SettingsController@ticketStore']);

			Route::get('email', ['as' => 'settings.email', 'uses' => 'SettingsController@email']);
			Route::post('email', ['as' => 'settings.email.store', 'uses' => 'SettingsController@emailStore']);
			Route::post('email/whentosend', ['as' => 'settings.email.whentosend', 'uses' => 'SettingsController@emailSettingStore']);

			Route::post('sendtestmail', ['as' => 'settings.email.sendtestmail', 'uses' => 'SettingsController@sendTestMail']);

			//
			Route::get('email-templates', ['as' => 'settings.email_templates', 'uses' => 'SettingsController@emailTemplates']);
			Route::get('email-templates/{id}', ['as' => 'settings.email_templates.edit', 'uses' => 'SettingsController@emailTemplateEdit']);
			Route::post('email-templates/{id}', ['as' => 'settings.email_templates.update', 'uses' => 'SettingsController@emailTemplateUpdate']);


		});

		Route::post('/ckeditor/file-upload', ['as' => 'ckeditor.image-upload', 'uses' => 'CkeditorUploadController@upload_images']);
		Route::resource('solars', 'SolarController');
        Route::resource('dss', 'DssController');
        Route::prefix('dss')->group(function () {
            Route::get('/get-record-id/{id}',[DssController::class,'get_record_id'])->name('dss.get-record-id');

        });
		Route::prefix('home-warranties')->group(function () {
			Route::get('/', [HomeWarrantyController::class, 'index'])->name('home-warranties.index');
			Route::get('/create', [HomeWarrantyController::class, 'create'])->name('home-warranties.create');
			Route::post('/store', [HomeWarrantyController::class, 'store'])->name('home-warranties.store');
			Route::get('/show/{home_warranty}', [HomeWarrantyController::class, 'show'])->name('home-warranties.show');
			Route::get('/edit/{home_warranty}', [HomeWarrantyController::class, 'edit'])->name('home-warranties.edit');
			Route::put('/update/{home_warranty}', [HomeWarrantyController::class, 'update'])->name('home-warranties.update');
			Route::get('/delete/{home_warranty}', [HomeWarrantyController::class, 'destroy'])->name('home-warranties.delete');
			Route::get('/export-home-warranty-sales-report', [HomeWarrantyController::class, 'exportHomeWarrantySalesReport'])->name('home-warranties.sales-report');
		});

		Route::get('solarExport', 'SolarController@export');
		Route::get('solar_client', 'SolarController@client')->name('solars.client');
		Route::resource('mortgages', 'MortgageController');
		Route::get('mortgageExport', 'MortgageController@export');
		Route::get('mortgage_client', 'MortgageController@client')->name('mortgages.client');
        Route::get('/line-chart',[DssController::class,'linechart'])->name('dss.line-chart');
        Route::post('/date-range',[DssController::class,'searchdate']);
        Route::get('/export-dss-sales-report', [DssController::class, 'exportDSSSalesReport'])->name('dss.sales-report');
		Route::resource('projects', 'ProjectController');
		
		Route::prefix('cmu-sales')->group(function () {
			Route::get('/import-cmu-sales-form', [CMUSaleController::class, 'importForm'])->name('cmu-sales.import-form');
			Route::post('/import-cmu-sales', [CMUSaleController::class, 'import'])->name('cmu-sales.import');
			Route::get('/cmu-sales-delete', [CMUSaleController::class, 'delete'])->name('cmu-sales-delete');
		});
		Route::prefix('call-analytic-sales')->group(function () {
			Route::get('/call-analytic-sales-form', [CallAnalyticController::class, 'importForm'])->name('call-analytic-sales.import-form');
			Route::post('/call-analytic-sales', [CallAnalyticController::class, 'import'])->name('call-analytic-sales.import');
			Route::get('/call-analytic-sales-stats',[CallAnalyticController::class, 'stats'])->name('call-analytic-sales.stats');
			Route::get('/call-analytic-sales-delete/{id}', [CallAnalyticController::class, 'delete'])->name('call-analytic-sales-delete');
		});
			Route::prefix('eddy-sales')->group(function () {
			Route::get('/eddy-sales-form', [EddyController::class, 'importForm'])->name('eddy-sales.import-form');
			Route::post('/eddy-sales', [EddyController::class, 'import'])->name('eddy-sales.import');
			Route::get('/eddy-sales-report', [EddyController::class, 'exportEddyReport'])->name('eddy-sales.eddy-export');
		});

		Route::get('/eddyusers', [EddyController::class, 'eddyusers'])->name('eddyusers');
		Route::get('/eddyuserCreate', [EddyController::class, 'eddyuserCreate'])->name('eddyuserCreate');
		Route::post('/eddyuserCreate', [EddyController::class, 'eddyuserCreate']);
		Route::get('/eddyuserDelete/{id?}', [EddyController::class, 'eddyuserDelete'])->name('eddyuserDelete');
		Route::get('/devsolar', 'SolarController@devsolar')->name('devsolar');
		
	});

});


Route::middleware('auth:sanctum')->group( function () {
	Route::get('/search_record', 'API\ApiController@search_record');
	Route::get('/get_record', 'API\ApiController@get_record');
});
