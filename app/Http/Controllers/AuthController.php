<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    use LogsActivity;

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);         


        $user = User::where('email', $credentials['email'])->first();

         // Verifica se usuário existe e se está ativo
        if ($user && $user->status != 1) {
            return back()->with('danger', 'Usuário inativo. Por favor entre em contato com o Administrador!');
        }

        
       // Tenta fazer login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'Bem-vindo, '.Auth::user()->name.'!');
        }     


        return back()->withErrors([
            'email' => 'As credenciais fornecidas estão incorretas',
        ])->withInput();

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'role' => 'required|in:admin,recruiter',
            'image' => 'file|mimes:jpg,jpeg,png|max:2048'
        ],
        [
            'name'               => 'Preencha o nome do usuário',
            'email.required'     => 'Preencha o e-mail',
            'email.email'        => 'Preencha um e-mail válido',
            'email.unique'       => 'O e-mail informado já está cadastrado',
            'password.required'  => 'Preencha a senha de acesso',
            'password.confirmed' => 'Confirmação de senha incorreta',
            'password.min'       => 'A senha precisa ter no mínimo 8 caracteres',
            'role'               => 'Selecione o perfil do usuário',
        ]);

        

        // Salvando imagem no banco e movendo arquivo para pasta.
        if($request->hasFile('image') && $request->file('image')->isValid()){

            $file = $request->file('image');

            $extension = $file->getClientOriginalExtension();

            $fileName = md5($file->getClientOriginalName() . microtime()) . '.' . $extension;

            $file->move(public_path('documents/users/image'), $fileName);

            $data['image'] = $fileName;

        } else {

            $data['image'] = '';

        }

        User::create($data);

        return redirect()->route('users.index')->with('success', 'Usuário registrado com sucesso!');
    }

    public function index(Request $request)
    {

        $query = User::query();


        // Formulário Busca Topo
          $form_busca = '';
            // Filtro nome
            if ($request->filled('form_busca')){
                //dd($request->form_busca);
                $query->where('name', 'like', '%'. $request->form_busca . '%');
                $form_busca = $request->form_busca;

            }

        // Filtro Função
        if ($request->filled('funcao')){

            if($request->funcao !== "Todas"){
                $query->where('role', $request->funcao);
            }

        }

        if($request->filled('filtro_data')) {
            $dias = match($request->filtro_data) {
                '7' => 7,
                '15' => 15,
                '30' => 30,
                '90' => 90,
                default => null,
            };

            if ($dias) {
                $query->where('created_at', '>=', now()->subDays($dias));
            }
        }

        // Filtro Status
        if ($request->filled('status')){

            $status = array();
            if(in_array('ativo', $request->status)){
                $status[] = '1';
            }
            if(in_array('inativo', $request->status)){
                $status[] = '0';
            }

            $query->whereIn('status', $status);

        }

        //dd($query->toRawSql());

        $users = $query->orderBy('created_at', 'desc')->get();

        return view('auth.index', compact('users', 'form_busca'));
    }


    public function edit(User $user){
        return view('auth.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {

        //dd($request->all());
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:8', //'required|confirmed|min:8',
            'role' => 'required|in:admin,recruiter',
            'image' => 'file|mimes:jpg,jpeg,png|max:2048'
        ],
        [
            'nome'               => 'Preencha o nome do usuário',
            'email.required'     => 'Preencha o e-mail',
            'email.email'        => 'Preencha um e-mail válido',
            'email.unique'       => 'O e-mail informado já está cadastrado',
            'password.confirmed' => 'Senhas diferentes. ',    
            'password.min'       => 'A senha precisa ter no mínimo 8 caracteres',        
            'role'               => 'Selecione o perfil do usuário',
        ]);

        // Remove password do array se estiver vazio
        if (empty($data['password'])) {
            unset($data['password']);
            unset($data['password_confirmation']);
        }


        $foto_atual = $user->image;

        // Salvando imagem no banco e movendo arquivo para pasta.
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $file = $request->file('image');

            $extension = $file->getClientOriginalExtension();

            $fileName = md5($file->getClientOriginalName() . microtime()) . '.' . $extension;

            $file->move(public_path('documents/users/image'), $fileName);

            $data['image'] = $fileName;

            if($foto_atual){
                $imagePath = public_path('documents/users/image/'. $foto_atual);
                if(file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            // if($foto_atual){
            //     unlink(public_path('documents/users/image/'. $foto_atual));
            // }
        }

        if($request->input('status') === 'on'){
            $data['status'] = '1';
        } else {
            $data['status'] = '0';
        }

         $user->update($data);
          // Salvando Log de criação
        $this->logAction('update', 'users', $user->id, 'Usuário atualizado com sucesso.');

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');

    }

    public function destroy(User $user)
    {
        //dd($user);
        // Se for um recrutador
        if ($user->role === 'recruiter') {
            // Encontrar um admin recrutador para transferir as vagas
            $adminRecruiter = User::where('role', 'admin')->first();

            if(!$adminRecruiter) {
                return redirect()->back()->with('danger', 'Nenhum recrutador admin encontrado para transferência das vagas.');
            }

            // Transferir todas as vagas associadas para o admin
            foreach($user->jobs as $job) {
                // Evita duplicação se já estiver associado
                if (!$job->recruiters->contains($adminRecruiter->id)) {
                    $job->recruiters()->attach($adminRecruiter->ad);
                }

                // Remove o recrutador atual da vaga
                $job->recruiters()->detach($user->id);
            }
        }

        // Soft delete
        $user->delete();

        // Salvando Log de criação
        $this->logAction('delete', 'users', $user->id, 'Usuario excluído.');

        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
    }


}
