<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Livro;
use App\Models\Genero;
use App\Models\Autor;
use App\Models\Editora;

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
        $livro=Livro::where('uuid',$idLivro)->orWhere('id_livro', $idLivro)->with(['genero','autores','editoras'])->first();
        return view('livros.show',[
            'livro'=>$livro
        ]);
    }
    
    public function create(){
        $generos = Genero::all();
        $autores = Autor::all();
        $editoras = Editora::all();
        return view('livros.create',[
            'generos'=>$generos,
            'autores'=>$autores,
            'editoras'=>$editoras
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
              'sinopse'=>['nullable', 'min:3', 'max:255']
               
          ]);

          if(Auth::check()){
            $userAtual=Auth::user()->id;
            $livro['id_user']=$userAtual;
        }
        $novoLivro['uuid']=Str::uuid();
//        dd($novoLivro);
        $autores=$r->id_autor;
        $editoras=$r->id_editora;
        $livro=Livro::create($novoLivro);
        $livro->autores()->attach($autores);
        $livro->editoras()->attach($editoras);
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
        $autores=Autor::all();
        $editoras=Editora::all();
        $livro=Livro::where('id_livro',$idLivro)->with(['genero','autores','editoras'])->first();
        $editorasLivro = [];
        $autoresLivro = [];
        
    foreach($livro->autores as $autor){
        $autoresLivro[] = $autor->id_autor;
    }
    foreach($livro->editoras as $editora){
        $editorasLivro[] = $editora->id_editora;
    }
        
        if(is_null($livro)){
                return redirect()->route('livros.index')->with('msg', 'O livro não existe');
            }
            else
            {
                return view('livros.edit',[
            'livro'=>$livro,
            'generos'=>$generos,
            'autores'=>$autores,
            'editoras'=>$editoras,
            'autoresLivro'=>$autoresLivro,
            'editorasLivro'=>$editorasLivro
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
              'sinopse'=>['nullable', 'min:3', 'max:255']
               
          ]);
                $autores=$r->id_autor;

        $livro->update($atualizarLivro);
                $livro->autores()->attach($autores);
                $livro->editoras()->attach($autores);
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
            
            $autoresLivro=Livro::where('id_livro',$idLivro)->with('autores')->first();
//            dd($livro, $autoresLivro->autores);
            $editorasLivro=Livro::where('id_livro',$idLivro)->with('editoras')->first();
            if(is_null($livro)){
                return redirect()->route('livros.index')->with('msg', 'O livro não existe');
            }
            else
            {
                $livro->autores()->detach($autoresLivro->autores);
                $livro->editoras()->detach($editorasLivro->editoras);
                $livro->delete();
                return redirect()->route('livros.index')->with('msg', 'Livro Eliminado');
            }
        }
        
    }

