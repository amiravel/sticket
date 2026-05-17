<?php


use Modules\Ticket\App\Http\Controllers\Client\TicketController;


Route::post('/tickets', [TicketController::class, 'store'])
    ->middleware('auth:sanctum');
