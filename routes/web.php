<?php

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

Route::get('/home', 'HomeController@index');
Route::get('/newTicket', 'HomeController@newproject');

//Ticket management
Route::get('/allTickets', 'TicketController@viewAllTickets');
Route::get('/viewTicket/{id}', 'TicketController@viewTicketById');
Route::get('/newTicket', 'TicketController@newTicketPage');
Route::post('newTicket', 'TicketController@newTicketSave');
Route::post('editTicket', 'TicketController@editTicket');
Route::post('ticketSearch', 'TicketController@ticketSearch');

