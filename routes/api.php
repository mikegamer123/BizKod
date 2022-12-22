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
Route::middleware(['cors'])->group(function () {
//CORS

//API route for register new user
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);


//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    ////USERS
    Route::prefix('users')->group(function () {
        //api route for returning all users or by ID
        Route::get('/get/{id?}', [App\Http\Controllers\UserController::class, 'getUsers']);

        //api route for updating user by ID
        Route::post('/put/{id}', [App\Http\Controllers\UserController::class, 'putUsers']);

        //api route for deleting users by ID
        Route::get('/delete/{id}', [App\Http\Controllers\UserController::class, 'deleteUsers']);
    });


    ////LANGUAGE_USERS
    Route::prefix('language_users')->group(function () {
        //api route for returning all colleges or by ID
        Route::get('/get/{id?}', [App\Http\Controllers\LanguageUsersController::class, 'getLanguageUser']);

        //api route for updating colleges by ID
        Route::post('/put/{id}', [App\Http\Controllers\LanguageUsersController::class, 'putLanguageUser']);

        //api route for deleting colleges by ID
        Route::get('/delete/{id}', [App\Http\Controllers\LanguageUsersController::class, 'deleteLanguageUser']);

        //api route for creating colleges
        Route::post('/create', [App\Http\Controllers\LanguageUsersController::class, 'addLanguageUser']);
    });

    ////POI
    Route::prefix('poi')->group(function () {
        //api route for returning all studyPrograms or by ID
        Route::get('/get/{id?}', [App\Http\Controllers\POIController::class, 'getPOI']);

        //api route for updating studyPrograms by ID
        Route::post('/put/{id}', [App\Http\Controllers\POIController::class, 'putPOI']);

        //api route for deleting studyPrograms by ID
        Route::get('/delete/{id}', [App\Http\Controllers\POIController::class, 'deletePOI']);

        //api route for creating studyPrograms
        Route::post('/create', [App\Http\Controllers\POIController::class, 'addPOI ']);
    });

    ////LOCATIONS
    Route::prefix('locations')->group(function () {
        //api route for returning all locations or by ID
        Route::get('/get/{id?}', [App\Http\Controllers\LocationsController::class, 'getLocations']);

        //api route for updating locations by ID
        Route::post('/put/{id?}', [App\Http\Controllers\LocationsController::class, 'putLocations']);

        //api route for deleting locations by ID
        Route::get('/delete/{id}', [App\Http\Controllers\LocationsController::class, 'deleteLocations']);

        //api route for creating locations
        Route::post('/create', [App\Http\Controllers\LocationsController::class, 'addLocations ']);
    });

    ////EVENTS
    Route::prefix('events')->group(function () {
        //api route for returning all posts or by ID
        Route::get('/get/{id?}', [App\Http\Controllers\EventsController::class, 'getEvents']);

        //api route for updating posts by ID
        Route::post('/put/{id}', [App\Http\Controllers\EventsController::class, 'putEvents']);

        //api route for deleting posts by ID
        Route::get('/delete/{id}', [App\Http\Controllers\EventsController::class, 'deleteEvents']);

        //api route for creating posts
        Route::post('/create', [App\Http\Controllers\EventsController::class, 'addEvents ']);
    });

    ////VISITORS
    Route::prefix('visitors')->group(function () {
        //api route for returning all companies or by ID
        Route::get('/get/{id?}', [App\Http\Controllers\VisitorsController::class, 'getVisitor']);

        //api route for updating companies by ID
        Route::post('/put/{id}', [App\Http\Controllers\VisitorsController::class, 'putVisitor']);

        //api route for deleting companies by ID
        Route::get('/delete/{id}', [App\Http\Controllers\VisitorsController::class, 'deleteVisitor']);

        //api route for creating companies
        Route::post('/create', [App\Http\Controllers\VisitorsController::class, 'addVisitor ']);
    });

    ////MENTOR_USER
    Route::prefix('mentor_users')->group(function () {
        //api route for returning all userCompanies or by ID
        Route::get('/get/{id?}', [App\Http\Controllers\MentorUserController::class, 'getMentorUser']);

        //api route for updating userCompanies by ID
        Route::post('/put/{id}', [App\Http\Controllers\MentorUserController::class, 'putMentorUser']);

        //api route for deleting userCompanies by ID
        Route::get('/delete/{id}', [App\Http\Controllers\MentorUserController::class, 'deleteMentorUser']);

        //api route for creating userCompanies
        Route::post('/create', [App\Http\Controllers\MentorUserController::class, 'addMentorUser ']);
    });

    ////CATEGORIES
    Route::prefix('categories')->group(function () {
        //api route for returning all categories or by ID
        Route::get('/get/{id?}', [App\Http\Controllers\CategoriesController::class, 'getCategories']);

        //api route for updating categories by ID
        Route::post('/put/{id}', [App\Http\Controllers\CategoriesController::class, 'putCategories']);

        //api route for deleting categories by ID
        Route::get('/delete/{id}', [App\Http\Controllers\CategoriesController::class, 'deleteCategories']);

        //api route for creating categories
        Route::post('/create', [App\Http\Controllers\CategoriesController::class, 'addCategories ']);
    });

    ////REVIEWS
    Route::prefix('reviews')->group(function () {
        //api route for returning all reviews or by ID
        Route::get('/get/{id?}', [App\Http\Controllers\ReviewsController::class, 'getReviews']);

        //api route for returning all reviews or by ID
        Route::get('/getByUser/{id}', [App\Http\Controllers\ReviewsController::class, 'getReviewsByUser']);

        //api route for updating reviews by ID
        Route::post('/put/{id}', [App\Http\Controllers\ReviewsController::class, 'putReviews']);

        //api route for deleting reviews by ID
        Route::get('/delete/{id}', [App\Http\Controllers\ReviewsController::class, 'deleteReviews']);

        //api route for creating reviews
        Route::post('/create', [App\Http\Controllers\ReviewsController::class, 'addReviews ']);
    });

    ////LANGUAGES
    Route::prefix('languages')->group(function () {
        //api route for returning all postCategories or by ID
        Route::get('/get/{id?}', [App\Http\Controllers\LanguagesController::class, 'getLanguage']);

        //api route for updating postCategories by ID
        Route::post('/put/{id}', [App\Http\Controllers\LanguagesController::class, 'putLanguage']);

        //api route for deleting postCategories by ID
        Route::get('/delete/{id}', [App\Http\Controllers\LanguagesController::class, 'deleteLanguage']);

        //api route for creating postCategories
        Route::post('/create', [App\Http\Controllers\LanguagesController::class, 'addLanguage ']);
    });

    ////IMAGES
    Route::prefix('images')->group(function () {
        //api route for User images
        Route::post('/users/{id}', [App\Http\Controllers\ImageController::class, 'imageUser']);

        //api route for POI images
        Route::post('/poi/{id}', [App\Http\Controllers\ImageController::class, 'imagePOI']);

        //api route for get images
        Route::get('/get/{id}', [App\Http\Controllers\ImageController::class, 'getImage']);

    });


        // API route for logout user
        Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);

});


});
