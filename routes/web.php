<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManageTitleController;
use App\Http\Controllers\ManageProposalController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ManageInventoryController;
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

Route::get('/', [IndexController::class, 'index'])->name('home');

// manage title
Route::group(['prefix' => 'manage-title', 'as' => 'manage-title.','middleware' => ['role:student|supervisor']], function (){
    Route::get('/view', [ManageTitleController::class, 'index'])
        ->name('view');
    Route::get('/my-title', [ManageTitleController::class, 'myTitles'])
        ->name('my-titles');

    Route::get('/edit/{title_id}', [ManageTitleController::class, 'edit'])
        ->name('edit');
    Route::post('/update/{title_id}', [ManageTitleController::class, 'update'])
        ->name('update');

    Route::post('/add', [ManageTitleController::class, 'add'])
        ->name('add');
    Route::get('/delete/{title_id}', [ManageTitleController::class, 'delete'])
        ->name('delete');

    Route::get('/view-book', [ManageTitleController::class, 'book'])
        ->name('view-book');
    Route::get('/book-title/{title_id}', [ManageTitleController::class, 'bookTitle'])
        ->name('book-title');
    Route::get('/remove-book-title/{title_id}', [ManageTitleController::class, 'removeBook'])
        ->name('remove-book-title');
});

// manage proposal
Route::group(['prefix' => 'manage-proposal', 'as' => 'manage-proposal.','middleware' => ['role:student|supervisor|coordinator']], function () {
    Route::get('/proposals', [ManageProposalController::class, 'viewAll'])
        ->middleware('permission:view all proposals')
        ->name('view-all');
    Route::get('/proposal', [ManageProposalController::class, 'viewOne'])
        ->middleware('permission:view proposal')
        ->name('view-one');
    Route::get('/detail/{proposal_id}', [ManageProposalController::class, 'detail'])
        ->name('detail');

    Route::get('/add', [ManageProposalController::class, 'create'])
        ->name('create');
    Route::post('/store', [ManageProposalController::class, 'store'])
        ->name('store');

    Route::get('/edit/{proposal_id}', [ManageProposalController::class, 'edit'])
        ->name('edit');
    Route::post('/update/{proposal_id}', [ManageProposalController::class, 'update'])
        ->name('update');

    Route::post('/approval/{proposal_id}', [ManageProposalController::class, 'setApproval'])
        ->name('approval');
});

// manage item
Route::group(['prefix' => 'manage-inventory', 'as' => 'manage-inventory.', 'middleware' => ['role:student|technician']], function (){
    Route::get('/items', [ManageInventoryController::class,'viewAll'])
        ->name('view-all');
    Route::get('/my-items', [ManageInventoryController::class, 'viewOne'])
        ->name('view-one');

    Route::post('/add', [ManageInventoryController::class, 'store'])
        ->name('store');

    Route::get('/show/{item_id}', [ManageInventoryController::class, 'show'])
        ->name('show');

    Route::get('/edit/{item_id}', [ManageInventoryController::class, 'edit'])
        ->name('edit');
    Route::post('/update/{item_id}', [ManageInventoryController::class, 'update'])
        ->name('update');
    Route::get('/delete/{item_id}', [ManageInventoryController::class, 'destroy'])
        ->name('destroy');

    Route::post('/approval/{item_id}', [ManageInventoryController::class, 'setApproval'])
        ->name('approval');
});

require __DIR__.'/auth.php';
