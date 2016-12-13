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

use App\Mail\Test;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/test-mail', function() {
//    Mail::send('emails.testmail',['name'=>'admin', 'company' => 'foro'], function(Message $message) {
//        $message->to('eaides@hotmail.com','Ernesto Aides')
//            ->from('admin@foro.com','The Admin')
//            ->subject('Test Mail by Mail Facade');
//    });
    Mail::to('eaides@hotmail.com','Ernesto Aides')
        ->send(new Test('Ernesto Natalio Aides'));
});