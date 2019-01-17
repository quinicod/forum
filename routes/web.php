<?php
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/saludo', 'PruebaController@index');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'ForumController@index');
Route::get('/forums/{forum}', 'ForumController@show');
Route::get('/posts/{post}', 'PostController@show');
Route::delete('/posts/{post}', 'PostController@destroy');
Route::post('/forums', 'ForumController@store');

Route::post('/posts', 'PostController@store');
Route::get('/images/{path}/{attachment}', function ($path, $attachment){
    // Lo siguiente devuelve el Path absoluto de "Storage"
    $storagePath = Storage::disk($path)->getDriver()->getAdapter()->getPathPrefix();
    $imageFilePath = $storagePath . $attachment;
    if(File::exists($imageFilePath)) {
        return Image::make($imageFilePath)->response();
    }
    });

Route::post('/replies', 'ReplyController@store');


