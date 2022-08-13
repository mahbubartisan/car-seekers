<?php

use \Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify'=>true]);




/*Route::get('/', 'Frontend\LandingController@index')->name('/');

Route::get('/policies', 'Frontend\LandingController@policies')->name('policies');
Route::get('/about-us', 'Frontend\LandingController@about')->name('about');
Route::get('/contact-us', 'Frontend\LandingController@contact')->name('contact');

Route::post('/booking-options', 'Frontend\BookingController@get_booking_options')->name('get-booking-options');
Route::resource('/my-bookings', 'Frontend\BookingController')->middleware('auth');
Route::resource('/ratings', 'Frontend\RatingController')->middleware('auth');*/


Route::get('/', 'Frontend\LandingController@index')->name('/');

Route::get('/policies', 'Frontend\LandingController@policies')->name('policies');
Route::get('/about-us', 'Frontend\LandingController@about')->name('about');
Route::get('/contact-us', 'Frontend\LandingController@contact')->name('contact');
//  && Auth::user()->role == 'Customer'
if (Auth::user()){
    if (Auth::user()->role('Customer')) {
        Route::group(['middleware' => ['auth', 'verified']], function () {
            Route::post('/booking-options', 'Frontend\BookingController@get_booking_options')->name('get-booking-options');
            Route::resource('/my-bookings', 'Frontend\BookingController');
            Route::resource('/ratings', 'Frontend\RatingController');

            // User Account Settings
            /*Route::get('/my-account', 'Frontend\AccountController@index')->name('my-account');
            Route::get('/edit-my-account', 'Frontend\AccountController@edit')->name('edit-my-account');
            Route::patch('/update-my-account}', 'Frontend\AccountController@update')->name('update-my-account');*/
        });
    }
}else{
    Route::post('/booking-options', 'Frontend\BookingController@get_booking_options')->name('get-booking-options');
    Route::group(['middleware' => ['auth','verified']], function(){
        Route::resource('/my-bookings', 'Frontend\BookingController')->middleware('verified');
        Route::resource('/ratings', 'Frontend\RatingController')->middleware('verified');
    });
}




Route::redirect('/home', '/dashboard');

Route::group(['middleware' => ['auth','verified']], function(){

    Route::get('/dashboard', 'Backend\DashboardController@index')->name('dashboard');

    // Users
    Route::resource('/users', 'Backend\UserController');
    Route::patch('/user-status-update/{id}', 'Backend\UserController@userStatusUpdate')->name('user-status-update');

    // User Account Settings
    Route::get('/account-settings', 'Backend\AccountController@index')->name('account-settings');
    Route::get('/edit-account-settings', 'Backend\AccountController@edit')->name('edit-account-settings');
    Route::patch('/update-account-settings}', 'Backend\AccountController@update')->name('update-account-settings');

    //Discounts
    Route::resource('/discounts', 'Backend\DiscountController');
    Route::patch('/discount-status-update/{id}', 'Backend\DiscountController@discountStatusUpdate')->name('discount-status-update');

    //Packages
    Route::resource('/packages', 'Backend\PackageController');
    Route::resource('/durations', 'Backend\DurationController');

    // Company Policies
    Route::resource('/company-policies', 'Backend\CompanyPolicyController');

    // Vehicles
    Route::resource('/vehicle', 'Backend\VehicleController');
    Route::patch('/vehicle-approval/{id}', 'Backend\VehicleController@approval')->name('vehicle.approval');
    Route::patch('/vehicle-status-update/{id}', 'Backend\VehicleController@vehicleStatusUpdate')->name('vehicle-status-update');

    // Drivers
    Route::resource('/drivers', 'Backend\DriverController');

    Route::resource('/bookings', 'Backend\BookingController');
    Route::get('/bookings/end-trip/{id}', 'Backend\BookingController@endTrip')->name('bookings.endTrip');

    Route::post('/filter', 'Backend\FilterController@dateFilter')->name('dateFilter');

});

// Create Session through Controller and trigger click on payment button through ajax success
Route::post('/booking-session-store', 'Frontend\BookingController@booking_session_store')->name('booking-session-store');
Route::post('/booking-due-session-store', 'Frontend\BookingController@booking_due_session_store')->name('booking-due-session-store');

// PaymentProcessing Routes
Route::get('payment-status',array('as'=>'payment.status','uses'=>'PaymentController@paymentInfo'));
//Route::get('payment',array('as'=>'payment','uses'=>'PaymentController@payment'));
Route::get('payment-cancel', function () {
    return 'Payment has been canceled';
});

