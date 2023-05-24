<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Task_assignmentController;
use App\Http\Controllers\Task_delController;









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



// Espace User 
Route::get('/app', function () {
    return view('saas-1.pou.main');
})->middleware(['auth:web', 'verified'])->name('app.dashboard');

Route::middleware('auth','role:admin')->group(function () {
    Route::get('/private', function () {
        return 'Bonjour Admin';
    });
});

       Route::middleware('auth:web')->group(function () {
       Route::get('/app/profile', [ProfileController::class, 'edit'])->name('profile.edit');
       Route::patch('/app/profile', [ProfileController::class, 'update'])->name('profile.update');
       Route::delete('/app/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    
	

	//client
	Route::resource('/app/client', ClientController::class)->middleware('auth');
	Route::get('/app/fiche-client/{numero}',[ClientController::class, 'voir'])->name('voirclient');
	Route::get('/app/voir-list-client',[ClientController::class, 'voirliste1'])->name('voirliste1');
	Route::get('/app/list-client',[ClientController::class, 'liste1'])->name('liste-client');
	//fin

	
	//projet
	Route::resource('/app/project', ProjectController::class)->middleware('auth');
	Route::get('/app/fiche-projet/{id}',[ProjectController::class, 'voir'])->name('voirprojet');
	Route::get('/app/voir-list-projet',[ProjectController::class, 'index'])->name('voirlistep');
	Route::get('/app/list-projet',[ProjectController::class, 'liste1'])->name('liste-projet');
	//fin

	//tache
	Route::resource('/app/task', TaskController::class)->middleware('auth');
	Route::get('/app/fiche-tache/{id}',[TaskController::class, 'voir'])->name('voirtache');
	Route::get('/app/liste-taches/{id}',[TaskController::class, 'index'])->name('listetaches');
	Route::post('/app/ajout-taches/{id}',[TaskController::class, 'store'])->name('taskadd');
	Route::get('/app/voir-list-tache',[TaskController::class, 'voirliste1'])->name('voirlistet');
	Route::get('/app/list-tache',[TaskController::class, 'liste1'])->name('liste-tache');
	//fin

	//task_assignment
	Route::post('/app/assignment/{id}',[Task_assignmentController::class, 'store'])->name('assignmentadd');
	

	//task_assignment
	Route::post('/app/delassignment/{id}',[Task_delController::class, 'store'])->name('assignmentdeladd');


	

	
	
	
	
	//trying pdf
	Route::get('/app/generate-pdf', [PDFController::class, 'generatePDF']);
	Route::get('/app/downloadPDF/{id}',[ProduitController::class, 'downloadPDF'])->name('download.pdf');
	
	


});

require __DIR__.'/auth.php';

// fin User



