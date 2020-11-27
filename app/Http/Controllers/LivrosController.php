<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;

class LivrosController extends Controller
{
    //
    public function index(){
        //$livros = Livro::all()->sortbydesc('idl');
        $livros= Livro::paginate(4);
        return view('livros.index',[
            'livros'=>$livros
        ]);
    }
    public function show(Request $request){
        $idLivro = $request->id;
        //$livro=Livro::findOrFail($idLivro);
        //$livro=Livro::find($idLivro);
        $livro=Livro::where('id_livro',$idLivro)->with(['genero','autores','editoras'])->first();
        return view('livros.show',[
            'livro'=>$livro
        ]);
    }
    
    public function create(){
        return view('livros.create');
    }
    
    public function store(Request $r){
          $novoLivro = $r->validate ([
              'titulo'=>['required', 'min:3', 'max:100'],
              'idioma'=>['nullable', 'min:3', 'max:10'],
              'total_paginas'=>['nullable', 'numeric', 'min:1'],
              'data_edicao'=>['nullable', 'date'],
              'isbn'=>['required', 'min:13', 'max:13'],
              'observacoes'=>['nullable', 'min:3', 'max:255'],
              'imagem_capa'=>['nullable'],
              'id_genero'=>['numeric', 'nullable'],
              'id_autor'=>['numeric', 'nullable'],
              'sinopse'=>['nullable', 'min:3', 'max:255']
               
          ]);
        
        $livro=Livro::create($novoLivro);
        /*    dd($novoLivro);      
        
        $titulo = $r->titulo;
        $idioma = $r->idioma;
        $total_paginas = $r->total_paginas;
        $data_edicao = $r->data_edicao;
        $isbn
        */
        
        return redirect()->route('livros.show', [
            'id'=>$livro->id_livro
        ]);
        
    }
    
    
    
    
    
    
    
    
    public function edit(Request $r){
        $idLivro = $r->id;
        
        $livro=Livro::where('id_livro',$idLivro)->with(['genero','autores','editoras'])->first();
        return view('livros.edit',[
            'livro'=>$livro
        ]);
    }
    
    
    
    
    public function update(Request $r){
        $idLivro = $r->id;
        $livro=Livro::where('id_livro',$idLivro)->first();
        $atualizarLivro = $r->validate ([
              'titulo'=>['required', 'min:3', 'max:100'],
              'idioma'=>['nullable', 'min:3', 'max:10'],
              'total_paginas'=>['nullable', 'numeric', 'min:1'],
              'data_edicao'=>['nullable', 'date'],
              'isbn'=>['required', 'min:13', 'max:13'],
              'observacoes'=>['nullable', 'min:3', 'max:255'],
              'imagem_capa'=>['nullable'],
              'id_genero'=>['numeric', 'nullable'],
              'id_autor'=>['numeric', 'nullable'],
              'sinopse'=>['nullable', 'min:3', 'max:255']
               
          ]);
        $livro->update($atualizarLivro);
        return redirect()->route('livros.show', [
            'id'=>$livro->id_livro
        ]);
    }
}
