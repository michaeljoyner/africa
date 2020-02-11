<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/', 'PagesController@home');
Route::get('about', 'PagesController@about');
Route::get('gallery', 'PagesController@gallery');

Route::get('donate', 'PagesController@donate');

Route::get('news', 'NewsController@index');
Route::get('news/{slug}', 'NewsController@show');

Route::get('/expeditions', 'ExpeditionsController@index');
Route::get('/expeditions/{slug}', 'ExpeditionsController@show');

Route::post('expeditions/{slug}/sign-up', 'ExpeditionSignUpController@handle');

Route::get('/priv', function () {
    return view('privacy');
});

Route::get('contact', 'ContactController@show');
Route::post('contact', 'ContactController@receiveMessage');

Route::get('/admin/login', 'Auth\LoginController@showLoginForm');
Route::post('/admin/login', 'Auth\LoginController@login');
Route::get('/admin/logout', 'Auth\LoginController@logout');

Route::post('/admin/users', 'Auth\RegisterController@register');

Route::get('admin/password/show/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('admin/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('admin/password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/', 'DashboardController@home');

    Route::get('users', 'UsersController@index');
    Route::post('users/{user}', 'UsersController@update');
    Route::delete('users/{user}', 'UsersController@delete');
    Route::get('users/{user}/edit', 'UsersController@edit');
    Route::get('users/{user}/password/edit', 'AdminPasswordController@edit');
    Route::post('users/{user}/password', 'AdminPasswordController@update');

    Route::get('posts', 'PostsController@index');
    Route::post('posts', 'PostsController@store');
    Route::get('posts/{post}', 'PostsController@show');
    Route::get('posts/{post}/edit', 'PostsController@edit');
    Route::post('posts/{post}', 'PostsController@update');
    Route::delete('posts/{post}', 'PostsController@delete');
    Route::post('posts/{post}/body', 'PostBodyController@update');

    Route::get('/posts/{post}/featuredimage', 'PostFeaturedImagesController@edit');
    Route::post('posts/{post}/images', 'PostImagesController@store');

    Route::get('posts/{post}/body/edit', 'PostBodyController@edit');

    Route::get('partners', 'PartnersController@index');
    Route::get('partners/{partner}', 'PartnersController@show');
    Route::get('partners/{partner}/edit', 'PartnersController@edit');
    Route::post('partners', 'PartnersController@store');
    Route::post('partners/{partner}', 'PartnersController@update');
    Route::delete('partners/{partner}', 'PartnersController@delete');

    Route::post('partners/{partner}/image', 'PartnerImagesController@store');

    Route::post('partners/{partner}/publish', 'PartnerPublishingController@update');

    Route::get('associates', 'SponsorsController@index');
    Route::get('associates/{sponsor}', 'SponsorsController@show');
    Route::get('associates/{sponsor}/edit', 'SponsorsController@edit');
    Route::post('associates', 'SponsorsController@store');
    Route::post('associates/{sponsor}', 'SponsorsController@update');
    Route::delete('associates/{sponsor}', 'SponsorsController@delete');

    Route::post('associates/{sponsor}/image', 'SponsorImagesController@store');

    Route::post('associates/{sponsor}/publish', 'SponsorPublishingController@update');

    Route::get('members', 'TeamMembersController@index');
    Route::get('members/{member}', 'TeamMembersController@show');
    Route::get('members/{member}/edit', 'TeamMembersController@edit');
    Route::post('members', 'TeamMembersController@store');
    Route::post('members/{member}', 'TeamMembersController@update');
    Route::delete('members/{member}', 'TeamMembersController@delete');

    Route::post('members/{member}/image', 'TeamMemberImagesController@store');

    Route::post('members/{member}/publish', 'TeamMemberPublishingController@update');

    Route::get('documents', 'DocumentsController@index');
    Route::get('documents/{document}', 'DocumentsController@show');
    Route::get('documents/{document}/edit', 'DocumentsController@edit');
    Route::post('documents', 'DocumentsController@store');
    Route::post('documents/{document}', 'DocumentsController@update');
    Route::delete('documents/{document}', 'DocumentsController@delete');

    Route::post('documents/{document}/file', 'DocumentFilesController@store');

    Route::post('documents/{document}/publish', 'DocumentPublishingController@update');

    Route::get('albums', 'AlbumsController@index');
    Route::get('albums/{album}', 'AlbumsController@show');
    Route::get('albums/{album}/edit', 'AlbumsController@edit');
    Route::post('albums', 'AlbumsController@store');
    Route::post('albums/{album}', 'AlbumsController@update');
    Route::delete('albums/{album}', 'AlbumsController@delete');

    Route::post('albums/{album}/main-image', 'AlbumMainImageController@store');

    Route::post('albums/{album}/publish', 'AlbumPublishingController@update');

    Route::get('expeditions', 'ExpeditionsController@index');
    Route::get('expeditions/{expedition}', 'ExpeditionsController@show');
    Route::get('expeditions/{expedition}/edit', 'ExpeditionsController@edit');
    Route::post('expeditions', 'ExpeditionsController@store');
    Route::post('expeditions/{expedition}', 'ExpeditionsController@update');
    Route::delete('expeditions/{expedition}', 'ExpeditionsController@delete');

    Route::post('expeditions/{expedition}/publish', 'ExpeditionPublishingController@update');

    Route::post('expeditions/{expedition}/image', 'ExpeditionImagesController@store');

    Route::group(['namespace' => 'Api', 'prefix' => 'api'], function () {

        Route::get('posts/{post}/images', 'PostFeaturedImagesController@index');
        Route::patch('posts/{post}/images/featured', 'PostFeaturedImagesController@update');
        Route::post('posts/{post}/images/featured', 'PostFeaturedImagesController@store');

        Route::post('posts/{post}/publish', 'PostPublishingController@update');

        Route::get('albums/{album}/gallery/images', 'AlbumGalleryImagesController@index');
        Route::post('albums/{album}/gallery/images', 'AlbumGalleryImagesController@store');
        Route::delete('albums/{album}/gallery/images/{media}', 'AlbumGalleryImagesController@delete');
    });
});