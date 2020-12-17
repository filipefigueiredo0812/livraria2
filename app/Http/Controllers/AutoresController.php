<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Autor;

class AutoresController extends Controller
{
    //
    public function index(){
        //$autores = Autor::all()->sortbydesc('idl');
        $autores= Autor::paginate(4);
        return view('autores.index',[
            'autores'=>$autores
        ]);
    }
    public function show(Request $request){
        $idAutores = $request->ida;
        //$autores=Autor::findOrFail($idAutores);
        //$autores=Autor::find($idAutores);
        $autores=Autor::where('id_autor',$idAutores)->with('livros')->first();
        return view('autores.show',[
            'autores'=>$autores
        ]);
    }
    
    public function create(){
        if(Gate::allows('admin')){
        return view('autores.create');
    }
    else{
        return redirect()->route('livros.index')
        ->with('mensagem','Não tem acesso para aceder à área pretendida.');
    }
    }
    
    public function store(Request $r){
          $novoAutor = $r->validate ([
              'nome'=>['required', 'min:3', 'max:100'],
              'nacionalidade'=>['nullable', 'min:3', 'max:20'],
              'data_nascimento'=>['nullable', 'date'],
              'fotografia'=>['nullable']
          ]);
        
        $autor=Autor::create($novoAutor);
        
        
        return redirect()->route('autores.show', [
            'ida'=>$autor->id_autor
        ]);
        
    }
    
    public function edit(Request $request){
        $idAutores = $request->ida;
        $autores=Autor::where('id_autor',$idAutores)->with('livros')->first();
        if(is_null($autores)){
                return redirect()->route('autores.index')->with('msg', 'O autor não existe');
            }
            else
            {
                return view('autores.edit',[
            'autores'=>$autores
        ]);
            }
        
    }
    
    
     public function update(Request $r){
        $idAutores = $r->ida;
        $autores=Autor::where('id_autor',$idAutores)->first();
         if(is_null($autores)){
                return redirect()->route('autores.index')->with('msg', 'O autor não existe');
            }
            else
            {
                $atualizarAutor = $r->validate ([
              'nome'=>['required', 'min:3', 'max:100'],
              'nacionalidade'=>['nullable', 'min:3', 'max:20'],
              'data_nascimento'=>['nullable', 'date'],
              'fotografia'=>['nullable']
          ]);
         $autores->update($atualizarAutor);
        return redirect()->route('autores.show',[
            'ida'=>$autores->id_autor
        ]);
            }
         
    }
    
    
    public function delete(Request $r){
        $idAutor = $r->ida;
        
        $autor=Autor::where('id_autor',$idAutor)->first();
            if(is_null($autor)){
                return redirect()->route('autores.index')->with('msg', 'O autor não existe');
            }
            else
            {
                return view('autores.delete',[
                'autor'=>$autor
                ]);
            }
        }
        
        
        
        
        public function destroy(Request $r){
        $idAutor = $r->ida;
    
        $autor=Autor::where('id_autor',$idAutor)->first();
            if(is_null($autor)){
                return redirect()->route('autores.index')->with('msg', 'O autor não existe');
            }
            else
            {
                $autor->delete();
                return redirect()->route('autores.index')->with('msg', 'Autor Eliminado');
            }
        }
    
}
