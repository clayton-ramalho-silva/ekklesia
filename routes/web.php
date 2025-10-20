<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardControler;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResumeController;
use Illuminate\Support\Facades\Route;

use App\Exports\CandidatesByJobExport;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\PublicResumeController;
use App\Http\Controllers\ResumeImportController;
use App\Http\Controllers\SelectionController;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;



Route::get('/painel', function(){

    return view('layouts.painel');
});


/** Rotas Publicas */

// Login
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::redirect('/', '/dashboard');


// Cadastro curriculo url publica
Route::get('cadastro-curriculo', [PublicResumeController::class, 'create'])->name('publicResume.create');
Route::post('cadastro-curriculo', [PublicResumeController::class, 'store'])->name('publicResume.store');


/** Rotas Privadas */ 


Route::middleware(['auth', 'perf.monitor'])->group(function(){
    // Jobs
    
    Route::put('/jobs/{job}/updateDataEntrevistaEmpresa', [JobController::class, 'updateDataEntrevistaEmpresa'])->name('jobs.updateDataEntrevistaEmpresa');
    Route::post('/jobs/startContraction/{jobId}', [JobController::class, 'startContraction'])->name('jobs.startContraction');
    Route::post('/jobs/endContraction/{jobId}', [JobController::class, 'endContraction'])->name('jobs.endContraction');
    Route::post('/jobs/storeHistory/{jobId}',[JobController::class, 'storeHistory'])->name('jobs.storeHistory');
    Route::put('/jobs/{jobId}/status', [JobController::class, 'updateStatus'])->name('jobs.updateStatus');
    Route::post('/jobs/{jobId}/associateRecruiter',[JobController::class, 'associateRecruiter'])->name('jobs.associateRecruiter');
    Route::resource('jobs', JobController::class);

    // Selections
    Route::post('/selections/storeSelection',[SelectionController::class, 'storeSelection'])->name('selections.storeSelection');
    Route::put('/selections/updateSelection/{selectionId}',[SelectionController::class, 'updateSelection'])->name('selections.updateSelection');

    // Resumes
    Route::put('/resumes/upadate-status/{id}', [ResumeController::class, 'updateStatus'])->name('resumes.updateStatus');
    Route::post('/resumes/storeHistory/{resumebId}',[ResumeController::class, 'storeHistory'])->name('resumes.storeHistory');
    Route::get('/resumes/deleteTeste', [ResumeController::class, 'deleteTeste']);
    Route::resource('resumes', ResumeController::class);
    
    // Interviews
    Route::get('/interviews/resume/showDev/{resumeId}',[InterviewController::class, 'showDev'])->name('interviews.showDev');
    Route::post('/interviews/resume/associarVaga', [InterviewController::class, 'associarVaga'])->name('interviews.associarVaga');
    Route::post('/interview/resume/desassociarVaga', [InterviewController::class, 'desassociarVaga'])->name('interviews.desassociarVaga');    
    Route::get('/interviews/resume/{resumeId}',[InterviewController::class, 'interviewResume'])->name('interviews.interviewResume');
    Route::put('/interviews/{jobId}/{resumeId}/status', [InterviewController::class, 'updateStatus'])->name('interviews.updateStatus');    
    Route::resource('interviews', InterviewController::class);
    Route::get('/dashboard', [DashboardControler::class, 'index'])->name('dashboard');
    Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
    
    // Company
    Route::put('companies/{companyId}/status', [CompanyController::class, 'updateStatus'])->name('companies.updateStatus');
    Route::resource('companies', CompanyController::class);

    // Importe JSON
    Route::get('/importar-curriculos/{filename}', [ResumeImportController::class, 'importar']);

    // Relatórios
    Route::prefix('reports')->group(function(){
        //Importações
        Route::get('/import/companies',[ReportController::class, 'showFormImportCompanies'])->name('showForm.companies.import');
        Route::post('/import/companies', [ReportController::class, 'importCompanies'])->name('companies.import');

        Route::get('/import/jobs', [ReportController::class, 'showFormImportJobs'])->name('shorForm.jobs.import');
        Route::post('/import/jobs', [ReportController::class, 'importJobs'])->name('jobs.import');

        Route::get('/import/resumes', [ReportController::class, 'showFormImportResumes'])->name('shorForm.resumes.import');
        Route::post('/import/resumes', [ReportController::class, 'importResumes'])->name('resumes.import');

        Route::get('/import/interviews', [ReportController::class, 'showFormImportInterviews'])->name('shorForm.interviews.import');
        Route::post('/import/interviews', [ReportController::class, 'importInterviews'])->name('interviews.import');



        Route::get('/candidates-by-job', [ReportController::class, 'candidatesByJob'])->name('reports.candidates.byJob');
        Route::get('/filled-jobs-by-company', [ReportController::class, 'filledJobsByCompany'])->name('reports.filledJobs.byCompany');
        Route::get('/interview-history', [ReportController::class, 'interviewHistory'])->name('reports.interviewHistory');

        // Exportações
        Route::get('/export/users',[ReportController::class, 'exportUsers'])->name('reports.export.users');
        Route::get('/export/interviews',[ReportController::class, 'exportInterviews'])->name('reports.export.interviews');
        Route::get('/export/jobs',[ReportController::class, 'exportJobs'])->name('reports.export.jobs');
        Route::get('/export/job/{job}/pdf', [ReportController::class, 'exportJobPdf'])->name('reports.export.job.pdf');
        Route::get('/export/resumes',[ReportController::class, 'exportResumes'])->name('reports.export.resumes');
        Route::get('/export/companies',[ReportController::class, 'exportCompanies'])->name('reports.export.companies');
        Route::get('/export/candidates-by-job/excel', [ReportController::class, 'exportCandidatesByJobExcel'])->name('reports.export.candidatesByJob.excel');
        Route::get('/export/candidates-by-job/pdf', [ReportController::class, 'exportCandidatesByJobPdf'])->name('reports.export.candidatesByJob.pdf');
    });

});


Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::get('users', [AuthController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [AuthController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AuthController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [AuthController::class, 'destroy'])->name('users.destroy');

    // Company
    //Route::put('companies/{companyId}/status', [CompanyController::class, 'updateStatus'])->name('companies.updateStatus');
   // Route::resource('companies', CompanyController::class);
});

Route::middleware(['auth', 'role:recruiter'])->group(function(){
});

// Verifica��o de CEP
Route::post('/getCep', [AjaxController::class, 'getCep'])->name('getCep');




