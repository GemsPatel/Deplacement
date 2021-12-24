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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DeplacementController;
use App\Http\Controllers\ImportExcelController;
use App\Http\Controllers\ListeController;
use Illuminate\Support\Facades\Artisan;

Route::get('/clear', function () {
      Artisan::call('cache:clear');
      Artisan::call('config:clear');
      Artisan::call('view:clear');
      Artisan::call('config:cache');
      return "will clear the all cached!";
  });
  
// Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
Route::get('/', [CustomAuthController::class, 'index'])->name('login');
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('logout', [CustomAuthController::class, 'signOut'])->name('logout');

Route::get('dashboard', [ImportExcelController::class, 'index'])->name('home');

Auth::routes();

Route::get('/liste', [ListeController::class, 'index'])->name('liste');
Route::get('/liste/{id}', [ListeController::class, 'liste'])->name('home.liste');
Route::get('/liste/show/{id}', [ListeController::class, 'show'])->name('home.liste.show');
Route::get('/import_excel', [ImportExcelController::class, 'index']);
Route::post('/import_excel/import', [ImportExcelController::class, 'import'])->name('upload-excel');

Route::resource('deplacement', 'DeplacementController');
Route::resource('militaire', 'MilitaireController');
Route::resource('grade', 'GradeController');
Route::resource('categorie', 'CategorieController');
Route::resource('statut', 'StatutController');
Route::resource('liste', 'ListeController');
Route::resource('organe', 'OrganeController');

Route::post('depart', [DeplacementController::class, 'depart'])->name('deplacement.depart');
Route::post('arrivee', [DeplacementController::class, 'arrivee'])->name('deplacement.arrivee');
