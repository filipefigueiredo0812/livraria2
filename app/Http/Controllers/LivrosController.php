<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use App\Models\Livro;
use App\Models\Genero;
use App\Models\Autor;
use App\Models\Editora;
use App\Models\User;
use App\Models\Like;

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
        $livro=Livro::where('uuid',$idLivro)->orWhere('id_livro', $idLivro)->with(['genero','autores','editoras','users'])->first();
        return view('livros.show',[
            'livro'=>$livro
        ]);

    }
    
    public function create(){
        if(Gate::allows('admin')){
            $generos = Genero::all();
            $autores = Autor::all();
            $editoras = Editora::all();
        
        return view('livros.create',[
            'generos'=>$generos,
            'autores'=>$autores,
            'editoras'=>$editoras
        ]);
        }
        else{
            return redirect()->route('livros.index')
        ->with('mensagem','Não tem acesso para aceder à área pretendida.');
        }
    }
    
    public function store(Request $r){
        if(Gate::allows('admin')){
          $novoLivro = $r->validate ([
              'titulo'=>['required', 'min:3', 'max:100'],
              'idioma'=>['nullable', 'min:3', 'max:10'],
              'total_paginas'=>['nullable', 'numeric', 'min:1'],
              'data_edicao'=>['nullable', 'date'],
              'isbn'=>['required', 'min:13', 'max:13'],
              'observacoes'=>['nullable', 'min:3', 'max:255'],
              'imagem_capa'=>['image','nullable','max:2000'],
              'id_genero'=>['numeric', 'nullable'],
              'sinopse'=>['nullable', 'min:3', 'max:255']
               
          ]);
          if($r->hasFile('imagem_capa')){


              $nomeImagem = $r->file('imagem_capa')->getClientOriginalName();
            
              $nomeImagem = time(). '_' . $nomeImagem;
              $guardarImagem = $r->file('imagem_capa')->storeAs('imagens\livros', $nomeImagem);

              $novoLivro['imagem_capa']= $nomeImagem;
          }
          if(Auth::check()){
            $userAtual=Auth::user()->id;
            $novoLivro['id_user']=$userAtual;
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
        else{
            return redirect()->route('livros.index')
        ->with('mensagem','Não tem acesso para aceder à área pretendida.');
        }
    }
    
    
    
    
    
    
    
    
    public function edit(Request $r){
        $idLivro = $r->id;
        $livro=Livro::where('id_livro',$idLivro)->with(['genero','autores','editoras'])->first();
        if(Gate::allows('atualizar-livro',$livro)||Gate::allows('admin')){
        $generos=Genero::all();
        $autores=Autor::all();
        $editoras=Editora::all();
        $editorasLivro = [];
        $autoresLivro = [];
    foreach($livro->autores as $autor){
        $autoresLivro[] = $autor->id_autor;
    }
    foreach($livro->editoras as $editora){
        $editorasLivro[] = $editora->id_editora;
    }
    
    return view('livros.edit',[
        'livro'=>$livro,
        'generos'=>$generos,
        'autores'=>$autores,
        'editoras'=>$editoras,
        'autoresLivro'=>$autoresLivro,
        'editorasLivro'=>$editorasLivro
    ]);
        }
    else{
        return redirect()->route('livros.index')
        ->with('mensagem','Não tem acesso para aceder à área pretendida.');
    }
    }




    public function update(Request $r){
        $idLivro=$r->id;
        $livro=Livro::where('id_livro', $idLivro)->first();
        if(Gate::allows('admin')){
          $atualizarLivro = $r->validate ([
              'titulo'=>['required', 'min:3', 'max:100'],
              'idioma'=>['nullable', 'min:3', 'max:10'],
              'total_paginas'=>['nullable', 'numeric', 'min:1'],
              'data_edicao'=>['nullable', 'date'],
              'isbn'=>['required', 'min:13', 'max:13'],
              'observacoes'=>['nullable', 'min:3', 'max:255'],
              'imagem_capa'=>['image','nullable','max:2000'],
              'id_genero'=>['numeric', 'nullable'],
              'sinopse'=>['nullable', 'min:3', 'max:255']
               
          ]);

          if($r->hasFile('imagem_capa')){


            $nomeImagem = $r->file('imagem_capa')->getClientOriginalName();
          
            $nomeImagem = time(). '_' . $nomeImagem;
            $guardarImagem = $r->file('imagem_capa')->storeAs('imagens\livros', $nomeImagem);
            
            $atualizarLivro['imagem_capa']= $nomeImagem;
            //dd($atualizarLivro);
        }
        $autores=$r->id_autor;
        $editoras=$r->id_editora;

        $livro->update($atualizarLivro);
        $livro->autores()->sync($autores);
        $livro->editoras()->sync($editoras);
        
        
        return redirect()->route('livros.show', [
            'id'=>$livro->id_livro
        ]);
        }
        else{
            return redirect()->route('livros.index')
        ->with('mensagem','Não tem acesso para aceder à área pretendida.');
        }
    }
        
        
        public function delete(Request $r){
        $idLivro = $r->id;
        
        $livro=Livro::where('id_livro',$idLivro)->first();
        if(Gate::allows('admin')){
            if(is_null($livro)){
                return redirect()->route('livros.index')->with('msg', 'O livro não existe');
            }
            else
            {
                return view('livros.delete',[
                'livro'=>$livro
                ]);
            }

            if(isset($livro->id_user)){
                if(Auth::user()->id==$livro->id_user){
                    return view('livros.delete',[
                        'livro'=>$livro
                        ]);
                }
                else{
                    return view('index');
                }
                }
            else{
                return view('livros.delete',[
                    'livro'=>$livro
                    ]);
                    
                }
        }
        else{
        return redirect()->route('livros.index')
        ->with('mensagem','Não tem acesso para aceder à área pretendida.');
        }
    }
        
        
        
        
        public function destroy(Request $r){
        $idLivro = $r->id;
        
        $livro=Livro::where('id_livro',$idLivro)->first();
            if(Gate::allows('admin')){
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
        else{
            return redirect()->route('livros.index')
        ->with('mensagem','Não tem acesso para aceder à área pretendida.');
        }
        }

    public function like(Request $r){
    //     $idLivro = $r->id;
        
    //     $novoLike['id_livro']=$idLivro;
    //     $novoLike['id_user']=Auth::user()->id;

    //     Like::create($novoLike);
    //     //$likes = Like::where('id_livro', $idLivro)->count();
    //     $likes = Like::where('id_user', Auth::user()->id)->where('id_livro', $idLivro)->first();
    //     return redirect()->route('livros.show',[
    //         'id'=>$idLivro
    //     ]);
    } 
        
}

