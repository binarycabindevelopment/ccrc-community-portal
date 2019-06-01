<?php

Route::namespace('Home')->prefix('/')->group(function(){
    Route::get('/', 'HomeController@show');
});

Auth::routes();

Route::namespace('Communities')->prefix('/community')->group(function(){
    Route::get('/', 'CommunityController@index');
    Route::prefix('/{uuid}')->group(function(){
        Route::get('/', 'CommunityController@show');
        Route::namespace('ContactSubmissions')->prefix('/contact-submission')->group(function(){
            Route::post('/', 'ContactSubmissionController@store');
        });
    });
});

Route::namespace('Dashboard')->prefix('/dashboard')->middleware('auth')->group(function(){
    Route::get('/', 'DashboardController@show');
});

Route::namespace('Account')->prefix('/account')->middleware('auth')->group(function(){
    Route::namespace('User')->prefix('/user')->group(function(){
        Route::get('/', 'UserController@edit');
        Route::patch('/', 'UserController@update');
        Route::namespace('Avatar')->prefix('/avatar')->group(function(){
            Route::get('/delete', 'AvatarController@destroy');
        });
    });
    Route::namespace('Billing')->prefix('/billing')->group(function(){
        Route::get('/', 'BillingController@show');
        Route::get('/edit', 'BillingController@edit');
        Route::patch('/', 'BillingController@update');
    });
    Route::namespace('CommunityManagementRequests')->prefix('/community-management-request')->group(function(){
        Route::get('/create', 'CommunityManagementRequestController@create');
        Route::post('/', 'CommunityManagementRequestController@store');
    });
});

Route::namespace('Manage')->prefix('/manage')->middleware('auth')->group(function(){
    Route::namespace('User')->prefix('/user')->group(function(){
        Route::get('/', 'UserController@index');
    });
    Route::namespace('CommunityManagementRequests')->prefix('/community-management-request')->group(function(){
        Route::get('/', 'CommunityManagementRequestController@index');
        Route::prefix('/{communityManagementRequestId}')->group(function(){
            Route::get('/approve', 'CommunityManagementRequestController@approve');
            Route::delete('/', 'CommunityManagementRequestController@destroy');
        });
    });
});