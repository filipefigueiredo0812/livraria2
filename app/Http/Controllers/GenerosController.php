<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genero;

class GenerosController extends Controller
{
    //
    public function index(){
        //$generos = Genero::all()->sortbydesc('idl');
        $generos= Genero::paginate(4);
        return view('generos.index',[
            'generos'=>$generos
        ]);
    }
    public function show(Request $request){
        $idgenero = $request->idg;
        //$genero=Genero::findOrFail($idgenero);
        //$genero=Genero::find($idgenero);
        $genero=Genero::where('id_genero',$idgenero)->with('livros')->first();
        return view('generos.show',[
            'genero'=>$genero
        ]);
    }
    
    public function create(){
        return view('generos.create');
    }
    
    public function store(Request $r){
          $novoGenero = $r->validate ([
              'designacao'=>['required', 'min:3', 'max:30'],
              'observacoes'=>['nullable', 'min:3', 'max:255']
          ]);
        
        $genero=Genero::create($novoGenero);
        
        
        return redirect()->route('generos.show', [
            'idg'=>$genero->id_genero
        ]);
        
    }
    
    
    public function edit(Request $r){
        $idgenero = $r->idg;
        
        $genero=Genero::where('id_genero',$idgenero)->with('livros')->first();
        
        if(is_null($genero)){
                return redirect()->route('generos.index')->with('msg', 'O genero não existe');
            }
            else
            {
                return view('generos.edit',[
            'genero'=>$genero
        ]);
            }
        
    }
    
    
    
    
    public function update(Request $r){
        $idgenero = $r->idg;
        
        $genero=Genero::where('id_genero',$idgenero)->first();
        
        if(is_null($genero)){
                return redirect()->route('generos.index')->with('msg', 'O genero não existe');
            }
            else
            {
                $atualizarGenero = $r->validate ([
              'designacao'=>['required', 'min:3', 'max:30'],
              'observacoes'=>['nullable', 'min:3', 'max:255']
          ]);
        $genero->update($atualizarGenero);
        return redirect()->route('generos.show', [
            'idg'=>$genero->id_genero
        ]);
            }
        
    }
    
    
    
    public function delete(Request $r){
        $idGenero = $r->idg;
        
        $genero=Genero::where('id_genero',$idGenero)->first();
            if(is_null($genero)){
                return redirect()->route('generos.index')->with('msg', 'O genero não existe');
            }
            else
            {
                return view('generos.delete',[
                'genero'=>$genero
                ]);
            }
        }
        
        
        
        
        public function destroy(Request $r){
        $idGenero = $r->idg;
    
        $genero=Genero::where('id_genero',$idGenero)->first();
            if(is_null($genero)){
                return redirect()->route('generos.index')->with('msg', 'O genero não existe');
            }
            else
            {
                $genero->delete();
                return redirect()->route('generos.index')->with('msg', 'Genero Eliminado');
            }
        }
    
}
