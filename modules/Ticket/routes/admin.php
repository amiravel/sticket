<?php


use Modules\Ticket\App\Http\Controllers\Admin\FirstAdmin\TicketBulkApproveController;
use Modules\Ticket\App\Http\Controllers\Admin\SecondAdmin\TicketBulkApproveController as SecondAdminBulkController;
use Modules\Ticket\App\Http\Controllers\Admin\FirstAdmin\TicketController;

Route::get('/tickets', [TicketController::class, 'index']);
Route::get('/tickets/{id}', [TicketController::class, 'show']);
Route::patch('/tickets/bulk-approve', [TicketBulkApproveController::class, 'update']);
Route::patch('/tickets/bulk-approve/second', [SecondAdminBulkController::class, 'update']);
Route::patch('/tickets/{id}', [TicketController::class, 'update']);
