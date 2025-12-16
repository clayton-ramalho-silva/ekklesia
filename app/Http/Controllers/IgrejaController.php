<?php

namespace App\Http\Controllers;

use App\Models\Igreja;
use Illuminate\Http\Request;
use App\Services\ImageService;
use Illuminate\Support\Str;

class IgrejaController extends Controller
{

    protected $imageService;
    /**
     * Display a category listing of the resource.
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Igreja::orderBy('id','DESC')->get();
        return view('admin.igreja.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.igreja.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        //dd('here');
        $request->validate([
            'nome' => 'required|string|max:255',
            'denominacao' => 'required|string|max:255',
            'cnpj' => 'required|string|max:20|unique:igrejas,cnpj',
            'endereco' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:igrejas,email',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $baseSlug = Str::slug($request->nome);
        $uniqueSlug = $baseSlug;
        $counter = 1;
        while (Igreja::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $baseSlug . '-' . $counter;
            $counter++;
        }
        $igreja = new Igreja();
        $igreja->nome = $request->nome;
        $igreja->denominacao = $request->denominacao;
        $igreja->cnpj = $request->cnpj;
        $igreja->endereco = $request->endereco;
        $igreja->telefone = $request->telefone;
        $igreja->email = $request->email;
        $igreja->slug = $uniqueSlug;

        if($image = $request->file('logo')){
            $igreja->logo = $this->imageService->compressAndStoreImage($image, $uniqueSlug, 'igreja');
        }

        $igreja->save();
       

        return redirect()->route('admin.igreja.index')->with('success', 'Igreja created successfully.');


    }

    /**
     * Display the specified resource.
     */
    public function show(Igreja $igreja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {        
        $igreja = Igreja::where('id', decrypt($id))->first();
        return view('admin.igreja.edit', compact('igreja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Igreja $igreja)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'denominacao' => 'required|string|max:255',
            'cnpj' => 'required|string|max:20|unique:igrejas,cnpj,'.$request->id,
            'endereco' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:igrejas,email,'.$request->id,
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $igreja = Igreja::find($request->id);
        $igreja->nome = $request->nome;
        $igreja->denominacao = $request->denominacao;
        $igreja->cnpj = $request->cnpj;
        $igreja->endereco = $request->endereco;
        $igreja->telefone = $request->telefone;
        $igreja->email = $request->email;

        if($image = $request->file('logo')){
            // Unlink the old image
            $oldImage = $igreja->logo;
            $image_path = public_path('images/igreja/'.$oldImage);
            if(file_exists($image_path)) {
                unlink($image_path);
            }

            // Add the new image
            $igreja->logo = $this->imageService->compressAndStoreImage($image, $igreja->slug, 'igreja');
        }       
        


        $igreja->save();

        return redirect()->route('admin.igreja.index')->with('success', 'Igreja updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //dd('here');

        $igreja = Igreja::where('id', decrypt($id))->first();
        //Unlink the logo image
        $oldImage = $igreja->logo;
        $image_path = public_path('images/igreja/'.$oldImage);
        if(file_exists($image_path)) {
            unlink($image_path);
        }

        $igreja->delete();
        return redirect()->back()->with('success', 'Igreja deleted successfully.');
    }
}
