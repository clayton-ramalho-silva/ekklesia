<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Interview;
use App\Models\Job;
use App\Models\Resume;
use App\Models\User;
use App\Services\DashboardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardControler extends Controller
{

    private $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
                                    
            // Dados para o Admin
            $totalJobs = $this->dashboardService->obterTotalVagas();
            $filledJobs = $this->dashboardService->obterTotalVagasPreenchidas();
            $openJobs = $this->dashboardService->obterTotalVagasAbertas();
            $closedJobs = $this->dashboardService->obterTotalVagasFechadas();
           
            
            $totalCurriculosAtivos = $this->dashboardService->obterTotalCurriculosAtivos();
            $totalCurriculosInativos = $this->dashboardService->obterTotalCurriculosInativos();
            $totalCurriculosProcesso = $this->dashboardService->obterTotalCurriculosProcesso();
            //$totalInterviews = Interview::count();
            $totalRecruiters = User::where('role', 'recruiter')->count();
            
            $totalEmpresasAtivas = $this->dashboardService->obterToralEmpresasAtivas();
            $totalEmpresasInativas = $this->dashboardService->obterTotalEmpresasInativas();
            
            $query = Job::with('company');
            $form_busca = '';
            if($request->filled('form_busca')){
                
                $query->whereHas('company', function($q) use ($request){
                    $q->where('nome_fantasia', 'like', '%' . $request->form_busca . '%');
                });

                $form_busca = $request->form_busca;         

            }
            
            $jobs = $query->orderBy('created_at', 'desc')->paginate(20);

            $resumes = Resume::orderBy('created_at', 'desc')->take(50)->get();
            //dd ($resumes);

            //dd($this->dashboardService->obterCurriculosFiltrados());

            return view('dashboard.admin', compact(
                'totalJobs', 
                'filledJobs', 
                'openJobs',
                'closedJobs',
                'totalCurriculosAtivos', 
                'totalCurriculosInativos',
                'totalCurriculosProcesso',
                'totalEmpresasAtivas', 
                'totalEmpresasInativas', 
                'form_busca' ,
                'jobs', 
                'resumes' 
            ));
        } else {
            // Dados para o Recrutador
            $totalEmpresasAtivas = Company::where('status', 'ativo')->count();
            $totalEmpresasInativas = Company::where('status', 'inativo')->count();

            $totalJobs = Job::whereHas('recruiters', function($query) use ($user){
                $query->where('recruiter_id', $user->id);
            })->count();

            $totalResumes = Resume::whereHas('jobs.recruiters', function($query) use($user){
                $query->where('recruiter_id', $user->id);
            })->count();

            $totalInterviews = Interview::with(['resume.jobs'])->whereHas('resume.jobs.recruiters', function($query) use($user){
                $query->where('recruiter_id', $user->id);
            })->count();

            $filledJobs = Job::select('filled_positions')
                ->whereHas('recruiters', function ($query) use ($user){
                    $query->where('recruiter_id', $user->id);
            })->count();

            $openJobs = Job::where('status', 'aberta')
                ->whereHas('recruiters', function ($query) use ($user){
                    $query->where('recruiter_id', $user->id);
            })->count();
            $jobs = Job::with('company')->whereHas('recruiters', function($query) use($user){
                $query->where('recruiter_id', $user->id);
            })->get();           

            $resumes = Resume::orderBy('created_at', 'desc')->take(50)->get();
            //dd($resumes);

            return view('dashboard.recruiter', compact(
                'totalJobs', 'totalResumes', 'totalInterviews',
                'filledJobs', 'openJobs', 'totalEmpresasAtivas', 'totalEmpresasInativas', 'jobs', 'resumes'
            ));



        }
    }
}
