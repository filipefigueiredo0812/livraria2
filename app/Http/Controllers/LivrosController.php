<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Genero;

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
        $generos = Genero::all();
        return view('livros.create',[
            'generos'=>$generos
        ]);
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
        
        $generos=Genero::all();
        $livro=Livro::where('id_livro',$idLivro)->with(['genero','autores','editoras'])->first();
        
        if(is_null($livro)){
                return redirect()->route('livros.index')->with('msg', 'O livro não existe');
            }
            else
            {
                return view('livros.edit',[
            'livro'=>$livro,
            'generos'=>$generos
        ]);
            }
        
    }
    
    
    
    
    public function update(Request $r){
        $idLivro = $r->id;
        $livro=Livro::where('id_livro',$idLivro)->first();
        if(is_null($livro)){
                return redirect()->route('livros.index')->with('msg', 'O livro não existe');
            }
            else
            {
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
        
        
        
        public function delete(Request $r){
        $idLivro = $r->id;
        
        $livro=Livro::where('id_livro',$idLivro)->first();
            if(is_null($livro)){
                return redirect()->route('livros.index')->with('msg', 'O livro não existe');
            }
            else
            {
                return view('livros.delete',[
                'livro'=>$livro
                ]);
            }
        }
        
        
        
        
        public function destroy(Request $r){
        $idLivro = $r->id;
        
        $livro=Livro::where('id_livro',$idLivro)->first();
            if(is_null($livro)){
                return redirect()->route('livros.index')->with('msg', 'O livro não existe');
            }
            else
            {
                $livro->delete();
                return redirect()->route('livros.index')->with('msg', 'Livro Eliminado');
            }
        }
        
    }

