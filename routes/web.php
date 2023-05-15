<?php

use App\Http\Controllers\DiagnosticController;
use App\Http\Controllers\HeaderDiagnosisResultController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\MappingDiagnosisScoreController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::group(['middleware'=>['is_admin']], function(){
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


        Route::get('/questions/fetch_detail_question', [QuestionController::class, "fetch_detail_question"]);
        Route::post('/questions/store_detail_question', [QuestionController::class, "store_detail_question"])->name(
            'questions.store_detail_question'
        );
        Route::put('/questions/update_detail_question', [QuestionController::class, "update_detail_question"])->name(
            'questions.update_detail_question'
        );
        Route::delete('/questions/destroy_detail_question', [QuestionController::class, "destroy_detail_question"])->name(
            'questions.destroy_detail_question'
        );

        Route::resource('questions', QuestionController::class);
        Route::resource('mapping-diagnosis-score', MappingDiagnosisScoreController::class);
        Route::get('/header-diagnosis-result/fetch_detail_diagnosis_result_by_hdr_id', [HeaderDiagnosisResultController::class, "fetch_detail_diagnosis_result_by_hdr_id"]);
        Route::resource('header-diagnosis-result', HeaderDiagnosisResultController::class);
    });
   
    Route::get('/test-diagnosis', [DiagnosticController::class, 'show_diagnostic_page'])->name('hdr.show_diagnostic_page');
    Route::post('/test-diagnosis', [DiagnosticController::class, 'store_diagnostic_result'])->name('hdr.store_diagnostic_result');
});

require __DIR__.'/auth.php';
