<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Editora;

class EditorasController extends Controller
{
    //
    public function index(){
        //$editoras = Editora::all()->sortbydesc('idl');
        $editoras= Editora::paginate(4);
        return view('editoras.index',[
            'editoras'=>$editoras
        ]);
    }
    public function show(Request $request){
        $idEditora = $request->ide;
        //$editora=Editora::findOrFail($idEditora);
        //$editora=Editora::find($idEditora);
        $editora=Editora::where('id_editora',$idEditora)->with('livros')->first();
        return view('editoras.show',[
            'editora'=>$editora
        ]);
    }
    
    public function create(){
        return view('editoras.create');
    }
    
    public function store(Request $r){
          $novoEditora = $r->validate ([
              'nome'=>['required', 'min:3', 'max:100'],
              'morada'=>['nullable', 'min:3', 'max:255'],
              'observacoes'=>['nullable', 'min:3', 'max:30']
          ]);
        
        $editora=Editora::create($novoEditora);
        
        
        return redirect()->route('editoras.show', [
            'ide'=>$editora->id_editora
        ]);
        
    }
    
    public function edit(Request $request){
        $idEditora = $request->ide;
        $editora=Editora::where('id_editora',$idEditora)->with('livros')->first();
        if(is_null($editora)){
            return redirect()->route('editoras.index')->with('msg', 'A editora não existe');
            }
        else{
            return view('editoras.edit',[
            'editora'=>$editora
        ]);
        }
    }
    
    public function update(Request $request){
        $idEditora = $request->ide;
        $editora=Editora::where('id_editora',$idEditora)->first();
        
        if(is_null($editora)){
            return redirect()->route('editoras.index')->with('msg', 'A editora não existe');
        }
        else{
            $atualizarEditora = $request->validate ([
              'nome'=>['required', 'min:3', 'max:100'],
              'morada'=>['nullable', 'min:3', 'max:255'],
              'observacoes'=>['nullable', 'min:3', 'max:30']
          ]);
        $editora->update($atualizarEditora);
        return redirect()->route('editoras.show',[
            'ide'=>$editora->id_editora
        ]);
        }
        
        
        
        
    }
    
    public function delete(Request $r){
        $idEditora = $r->ide;
        
        $editora=Editora::where('id_editora',$idEditora)->first();
            if(is_null($editora)){
                return redirect()->route('editoras.index')->with('msg', 'A editora não existe');
            }
            else
            {
                return view('editoras.delete',[
                'editora'=>$editora
                ]);
            }
        }
        
        
        
        
        public function destroy(Request $r){
        $idEditora = $r->ide;
    
        $editora=Editora::where('id_editora',$idEditora)->first();
            if(is_null($editora)){
                return redirect()->route('editoras.index')->with('msg', 'A editora não existe');
            }
            else
            {
                $editora->delete();
                return redirect()->route('editoras.index')->with('msg', 'Editora Eliminada');
            }
        }
    
}
