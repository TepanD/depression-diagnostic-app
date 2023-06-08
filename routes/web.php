<?php

use App\Http\Controllers\DiagnosticController;
use App\Http\Controllers\HeaderDiagnosisResultController;
use App\Http\Controllers\InformationPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\MappingDiagnosisScoreController;
use App\Http\Controllers\UserController;
use App\Models\MappingDiagnosisScore;
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

// Route::get('/administrator1234', function () {
//     return view('welcome');
// });


Route::middleware('auth')->group(function () {
    Route::get('/', [DiagnosticController::class, 'show_diagnostic_page'])->name('hdr.show_diagnostic_page');

    Route::get('/information-page', [InformationPageController::class, 'show_information_page'])->name('info.show_information_page');
    
    Route::group(['middleware'=>['is_admin']], function(){


        Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        //############### Routes for HeaderQuestion, DetailQuestions #############
        Route::get('/admin/questions/search_header_question', [QuestionController::class, "search_header_question"]);
        Route::get('/admin/questions/fetch_detail_question', [QuestionController::class, "fetch_detail_question"]);
        Route::post('/questions/store_detail_question', [QuestionController::class, "store_detail_question"])->name(
            'questions.store_detail_question'
        );
        Route::put('/questions/update_detail_question', [QuestionController::class, "update_detail_question"])->name(
            'questions.update_detail_question'
        );
        Route::delete('/questions/destroy_detail_question', [QuestionController::class, "destroy_detail_question"])->name(
            'questions.destroy_detail_question'
        );

        Route::put('/questions/update_hdq_is_active', [QuestionController::class, "update_hdq_is_active"])->name(
            'questions.update_hdq_is_active'
        );
        Route::resource('questions', QuestionController::class);
        //############### END OF Routes for HeaderQuestion, DetailQuestions #############

        //############### Routes for Mapping Diagnosis Score #############
        Route::put('/mapping-diagnosis-score/update_mapds_is_active', [MappingDiagnosisScoreController::class, "update_mapds_is_active"])->name(
            'mds.update_mapds_is_active'
        );
        Route::resource('mapping-diagnosis-score', MappingDiagnosisScoreController::class);
        //############### END OF Routes for Mapping Diagnosis Score #############

        //############### Routes for Diagnosis Results #############
        Route::get('/header-diagnosis-result/fetch_detail_diagnosis_result_by_hdr_id', [HeaderDiagnosisResultController::class, "fetch_detail_diagnosis_result_by_hdr_id"]);
        Route::resource('header-diagnosis-result', HeaderDiagnosisResultController::class);
        //############### END OF Routes for Diagnosis Results #############

        //############### Routes for User List #############
        Route::put('/users/update_user_role', [UserController::class, "update_user_role"])->name('user.update_user_role');
        Route::get('/admin/users', [UserController::class, "show_all_users"])->name('user.show_all_users');
        //############### END OF Routes for User List #############
    });
   
    // Route::get('/test-diagnosis', [DiagnosticController::class, 'show_diagnostic_page'])->name('hdr.show_diagnostic_page');
    Route::post('/test-diagnosis', [DiagnosticController::class, 'store_diagnostic_result'])->name('hdr.store_diagnostic_result');
    Route::get('/admin/demo-diagnosis', [DiagnosticController::class, 'demo_diagnostic_page'])->name('hdr.demo_diagnostic');
    Route::get('download-pdf',[DiagnosticController::class, 'download_pdf'])->name('hdr.download_pdf');
});



require __DIR__.'/auth.php';