<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect('/login');
});



Route::get("/login", "App\Http\Controllers\Auth\LoginController@loginview")->name('/login');
Route::post("/login", "App\Http\Controllers\Auth\LoginController@login")->name('/login');

Route::get("/forgot-password", "App\Http\Controllers\Auth\LoginController@forgotview")->name('/forgot-password');
Route::post("/forgot-password", "App\Http\Controllers\Auth\LoginController@forgot")->name('/forgot-password');

Route::get("/reset-password/{token1}/{token2}", "App\Http\Controllers\Auth\LoginController@resetview")->name('/reset-password/{token1}/{token2}');
Route::post("/reset-password/{token1}/{token2}", "App\Http\Controllers\Auth\LoginController@reset")->name('/reset-password/{token1}/{token2}');

Route::get("/logout", "App\Http\Controllers\Auth\LoginController@logout")->name('/logout');

Route::group(['middleware' => 'auth'], function () {

    // super admin
    Route::group(['prefix' => 'super-admin'], function () {
        Route::get("/", "App\Http\Controllers\SuperAdmin\DashboardController@index")->name('/');
        Route::get("/dashboard", "App\Http\Controllers\SuperAdmin\DashboardController@index")->name('/dashboard');
        Route::get("/managebusiness", "App\Http\Controllers\SuperAdmin\ManageBusinessController@index")->name('managebusiness');
        Route::post('/business/{id}/toggle-status', ['App\Http\Controllers\SuperAdmin\ManageBusinessController@toggleStatus'])->name('business.toggleStatus');
        Route::get('/createbusiness', 'App\Http\Controllers\SuperAdmin\ManageBusinessController@create')->name('businesses.create');
        Route::post('/businesses', 'App\Http\Controllers\SuperAdmin\ManageBusinessController@storeBusiness')->name('businesses.store');
        // routes/web.php
        Route::get('/businesses/{id}/edit', 'App\Http\Controllers\SuperAdmin\ManageBusinessController@edit')
            ->name('businesses.edit');

        Route::put('/businesses/{id}', 'App\Http\Controllers\SuperAdmin\ManageBusinessController@update')
        ->name('businesses.update');
        // routes/web.php
        Route::post('/businesses/{id}/update-status', 'App\Http\Controllers\SuperAdmin\ManageBusinessController@updateStatus')
            ->name('businesses.update-status');
        Route::delete('/businesses/{id}', 'App\Http\Controllers\SuperAdmin\ManageBusinessController@destroy')
            ->name('businesses.destroy');
        Route::get("/manageadmins", "App\Http\Controllers\SuperAdmin\ManageAdminController@index")->name('admins.manage');
        Route::get('manageadmins/create', 'App\Http\Controllers\SuperAdmin\ManageAdminController@create')->name('admins.create');
        Route::post('manageadmins/admins', 'App\Http\Controllers\SuperAdmin\ManageAdminController@store')->name('admins.store');
        // Admin list route
        Route::get('/admin-list', 'App\Http\Controllers\SuperAdmin\ManageAdminController@adminList')
            ->name('admin.list');

        Route::get('manageadmins/admins/{id}/edit', 'App\Http\Controllers\SuperAdmin\ManageAdminController@edit')
    ->name('admin.edit');

        Route::post('/manageadmins/update/{id}', 'App\Http\Controllers\SuperAdmin\ManageAdminController@update')->name('admin.update');
        Route::delete('/manageadmins/delete/{id}', 'App\Http\Controllers\SuperAdmin\ManageAdminController@destroy')->name('admin.destroy');



        //profile
        Route::get('/profile', "App\Http\Controllers\SuperAdmin\ProfileController@profileview")->name('/profile');
        Route::post('/profilephotoupload', "App\Http\Controllers\SuperAdmin\ProfileController@profilephotoupload")->name('/profilephotoupload');
        Route::post('/profileupdate', "App\Http\Controllers\SuperAdmin\ProfileController@profileupdate")->name('/profileupdate');



        Route::get('/changepassword', "App\Http\Controllers\SuperAdmin\ProfileController@changepassword")->name('/changepassword');
        Route::post('/changepassword', "App\Http\Controllers\SuperAdmin\ProfileController@changepasswordsubmit")->name('/changepassword');
    });

    //admin
    Route::group(['prefix' => 'admin'], function () {
        Route::get("/", "App\Http\Controllers\Admin\DashboardController@index")->name('/');
        Route::get("/dashboard", "App\Http\Controllers\Admin\DashboardController@index")->name('/dashboard');

        //creator-list
        Route::get("/creator-list", "App\Http\Controllers\Admin\LeadlistController@creatorview")->name('/creator-list');
        Route::post("/creator-list", "App\Http\Controllers\Admin\LeadlistController@transfer")->name('/creator-list');
        Route::post("/creator-list/delete", "App\Http\Controllers\Admin\LeadlistController@delete")->name('/creator-list/delete');
        //online-list
        Route::get("/online-list", "App\Http\Controllers\Admin\LeadlistController@onlineview")->name('/online-list');
        Route::post("/online-list", "App\Http\Controllers\Admin\LeadlistController@transfer")->name('/online-list');

        //upload leads
        Route::get("/upload-list", "App\Http\Controllers\Admin\LeadlistController@upload")->name('/upload');
        Route::post("/upload-list", "App\Http\Controllers\Admin\LeadlistController@uploaddata")->name('/upload');

        //allleads
        Route::get("/allleads", "App\Http\Controllers\Admin\LeadlistController@allleads")->name('/allleads');
        Route::get("/lead-detail/{id}", "App\Http\Controllers\Admin\LeadsController@leadview")->name('/lead-detail/{id}');
        Route::get("/lead-edit/{id}", "App\Http\Controllers\Admin\LeadsController@leadedit")->name('/lead-edit/{id}');
        Route::post("/lead-edit/{id}", "App\Http\Controllers\Admin\LeadsController@add")->name('/lead-edit/{id}');
        //lead status
        Route::get("/list/{type}", "App\Http\Controllers\Admin\LeadsStatusController@leads")->name('/list/{type}');

        Route::get("/mylist/{type}", "App\Http\Controllers\Admin\MyStatusController@leads")->name('/mylist/{type}');

        Route::get("/mylead/editform/{id}", "App\Http\Controllers\Admin\MyStatusController@leadedit")->name('/mylead/editform/{id}');
        Route::post("/mylead/editform/{id}", "App\Http\Controllers\Admin\MyStatusController@add")->name('/mylead/editform/{id}');
        Route::get("/mylead/detail/{id}", "App\Http\Controllers\Admin\MyStatusController@leadview")->name('/mylead/detail/{id}');

        Route::get("/mylead/service/{id}", "App\Http\Controllers\Admin\AddServiceController@index")->name('/mylead/service/{id}');
        Route::post('/ser-gen/{id}', 'App\Http\Controllers\Admin\AddServiceController@gen')->name('/ser-gen/{id}');
        Route::get('/ser-gen-d/{id}', 'App\Http\Controllers\Admin\AddServiceController@gend')->name('/ser-gen-d/{id}');
        Route::post('/ser-pay/{id}', 'App\Http\Controllers\Admin\AddServiceController@pay')->name('/ser-pay/{id}');
        Route::get('/ser-pay-d/{id}', 'App\Http\Controllers\Admin\AddServiceController@payd')->name('/ser-pay-d/{id}');
        Route::get('/mylead/print/{id}', 'App\Http\Controllers\Admin\AddServiceController@print')->name('/mylead/print/{id}');
        //update status
        Route::post("/update-status", "App\Http\Controllers\Admin\MyStatusController@leadupdate")->name('/update-status');


        //schedule
        Route::get("/schedule", "App\Http\Controllers\Admin\LeadsScheduleController@leads")->name('/schedule');
        Route::post("/schedule/delete", "App\Http\Controllers\Admin\LeadsScheduleController@delete")->name('/schedule/delete');


        //service
        Route::get("/service", "App\Http\Controllers\Admin\ServiceController@index")->name('/service');
        Route::post("/service", "App\Http\Controllers\Admin\ServiceController@add")->name('/service');
        Route::get("/service/{id}", "App\Http\Controllers\Admin\ServiceController@index")->name('/service{id}');
        Route::post("/service/{id}", "App\Http\Controllers\Admin\ServiceController@add")->name('/service{id}');
        Route::get('/service-active/{id}', 'App\Http\Controllers\Admin\ServiceController@active')->name('/service-active/{id}');
        Route::get('/service-deactive/{id}', 'App\Http\Controllers\Admin\ServiceController@deactive')->name('/service-deactive/{id}');
        Route::post('/service/delete', 'App\Http\Controllers\Admin\ServiceController@delete')->name('/service/delete');


        //users
        Route::get("/users", "App\Http\Controllers\Admin\UsersController@index")->name('/users');
        Route::get("/users/{type}", "App\Http\Controllers\Admin\UsersController@index")->name('/users/{type}');
        Route::post("/users", "App\Http\Controllers\Admin\UsersController@add")->name('/users');
        Route::get("/users/block/{id}", "App\Http\Controllers\Admin\UsersController@block")->name('/users/block/{id}');
        Route::get("/users/unblock/{id}", "App\Http\Controllers\Admin\UsersController@unblock")->name('/users/unblock/{id}');
        Route::get("/users/active/{id}", "App\Http\Controllers\Admin\UsersController@active")->name('/users/active/{id}');
        Route::get("/users/deactive/{id}", "App\Http\Controllers\Admin\UsersController@deactive")->name('/users/deactive/{id}');
        Route::post("/users-data/delete", "App\Http\Controllers\Admin\UsersController@delete")->name('/users-data/delete');
        Route::get("/users/view/{id}", "App\Http\Controllers\Admin\UsersController@view")->name('/users/view/{id}');
        Route::post("/users/view/{id}", "App\Http\Controllers\Admin\UsersController@update")->name('/users/view/{id}');


        //profile
        Route::get('/profile', "App\Http\Controllers\Admin\ProfileController@profileview")->name('/profile');
        Route::post('/profilephotoupload', "App\Http\Controllers\Admin\ProfileController@profilephotoupload")->name('/profilephotoupload');
        Route::post('/profileupdate', "App\Http\Controllers\Admin\ProfileController@profileupdate")->name('/profileupdate');



        Route::get('/changepassword', "App\Http\Controllers\Admin\ProfileController@changepassword")->name('/changepassword');
        Route::post('/changepassword', "App\Http\Controllers\Admin\ProfileController@changepasswordsubmit")->name('/changepassword');

        // subscription
        Route::get('/subscription/subscription-details', "App\Http\Controllers\Admin\SubscriptionController@index")->name('/subscription');
    });






    //lead-creator
    Route::group(['prefix' => 'lead-creater'], function () {
        Route::get("/", "App\Http\Controllers\LeadCreator\DashboardController@index")->name('/');
        Route::get("/dashboard", "App\Http\Controllers\LeadCreator\DashboardController@index")->name('/dashboard');


        //create myleads
        Route::get("/create", "App\Http\Controllers\LeadCreator\LeadController@create")->name('/create');
        Route::post("/create", "App\Http\Controllers\LeadCreator\LeadController@add")->name('/create');

        Route::get("/myleads", "App\Http\Controllers\LeadCreator\LeadController@myleads")->name('/myleads');
        Route::post("/myleads", "App\Http\Controllers\Admin\LeadlistController@transfer")->name('/myleads');
        Route::post("/myleads/delete", "App\Http\Controllers\LeadCreator\LeadController@delete")->name('/myleads/delete');

        //online-list
        Route::get("/onlineleads", "App\Http\Controllers\LeadCreator\LeadController@onlineview")->name('/onlineleads');
        Route::post("/onlineleads", "App\Http\Controllers\Admin\LeadlistController@transfer")->name('/onlineleads');

        Route::get("/lead-detail/{id}", "App\Http\Controllers\Admin\LeadsController@leadview")->name('/lead-detail/{id}');



        Route::get("/mylist/{type}", "App\Http\Controllers\LeadCreator\LeadsBillingController@leads")->name('/mylist/{type}');
        Route::get("/mylead/editform/{id}", "App\Http\Controllers\LeadCreator\LeadsBillingController@leadedit")->name('/mylead/editform/{id}');
        Route::post("/mylead/editform/{id}", "App\Http\Controllers\LeadCreator\LeadsBillingController@add")->name('/mylead/editform/{id}');
        Route::get("/mylead/detail/{id}", "App\Http\Controllers\LeadCreator\LeadsBillingController@leadview")->name('/mylead/detail/{id}');
        Route::post("/update-status", "App\Http\Controllers\LeadCreator\LeadsBillingController@leadupdate")->name('/update-status');




        //profile
        Route::get('/profile', "App\Http\Controllers\LeadCreator\ProfileController@profileview")->name('/profile');
        Route::post('/profilephotoupload', "App\Http\Controllers\LeadCreator\ProfileController@profilephotoupload")->name('/profilephotoupload');
        Route::post('/profileupdate', "App\Http\Controllers\LeadCreator\ProfileController@profileupdate")->name('/profileupdate');

        Route::get('/changepassword', "App\Http\Controllers\LeadCreator\ProfileController@changepassword")->name('/changepassword');
        Route::post('/changepassword', "App\Http\Controllers\LeadCreator\ProfileController@changepasswordsubmit")->name('/changepassword');

    });






    //tele-caller
    Route::group(['prefix' => 'tele-caller'], function () {


        Route::get("/", "App\Http\Controllers\Tele\DashboardController@index")->name('/');
        Route::get("/dashboard", "App\Http\Controllers\Tele\DashboardController@index")->name('/dashboard');

        //create lead (only if Admin has enabled "Allow Lead Creation" for this telecaller)
        Route::get("/create", "App\Http\Controllers\Tele\LeadController@create")->name('/create');
        Route::post("/create", "App\Http\Controllers\Tele\LeadController@add")->name('/create');

        //bulk upload leads (only if Admin has enabled "Allow Lead Creation" for this telecaller)
        Route::get("/upload-list", "App\Http\Controllers\Tele\LeadController@upload")->name('/upload-list');
        Route::post("/upload-list", "App\Http\Controllers\Tele\LeadController@uploaddata")->name('/upload-list');

        //update status
        Route::post("/update-status", "App\Http\Controllers\Tele\LeadsStatusController@leadupdate")->name('/update-status');


        //all-leads (every lead assigned to this telecaller, with hot/warm/cold/dead marking)
        Route::get("/all-leads", "App\Http\Controllers\Tele\LeadsController@allLeads")->name('/all-leads');
        Route::post("/all-leads/mark-temperature", "App\Http\Controllers\Tele\LeadsController@markTemperature")->name('/all-leads/mark-temperature');

        //transferred-list
        Route::get("/transferred-list", "App\Http\Controllers\Tele\LeadsController@transferred")->name('/transferred-list');
        Route::post("/transferred-list", "App\Http\Controllers\Tele\LeadsController@capture")->name('/transferred-list');
        Route::get("/captured-list", "App\Http\Controllers\Tele\LeadsController@captured")->name('/captured-list');
        Route::post("/captured-list/delete", "App\Http\Controllers\Tele\LeadsController@delete")->name('/captured-list/delete');
        Route::get("/lead-detail/{id}", "App\Http\Controllers\Tele\LeadsController@leadview")->name('/lead-detail/{id}');
        Route::get("/lead-edit/{id}", "App\Http\Controllers\Tele\LeadsController@leadedit")->name('/lead-edit/{id}');
        Route::post("/lead-edit/{id}", "App\Http\Controllers\Tele\LeadsController@add")->name('/lead-edit/{id}');


        //lead status
        Route::get("/list/{type}", "App\Http\Controllers\Tele\LeadsStatusController@leads")->name('/list/{type}');

        //schedule
        Route::get("/schedule", "App\Http\Controllers\Tele\LeadsScheduleController@leads")->name('/schedule');
        Route::post("/schedule/delete", "App\Http\Controllers\Tele\LeadsScheduleController@delete")->name('/schedule/delete');



        //profile
        Route::get('/profile', "App\Http\Controllers\Tele\ProfileController@profileview")->name('/profile');
        Route::post('/profilephotoupload', "App\Http\Controllers\Tele\ProfileController@profilephotoupload")->name('/profilephotoupload');
        Route::post('/profileupdate', "App\Http\Controllers\Tele\ProfileController@profileupdate")->name('/profileupdate');

        Route::get('/changepassword', "App\Http\Controllers\Tele\ProfileController@changepassword")->name('/changepassword');
        Route::post('/changepassword', "App\Http\Controllers\Tele\ProfileController@changepasswordsubmit")->name('/changepassword');

    });
});
