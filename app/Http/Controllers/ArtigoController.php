/* 
 * União Metropolitana de Educação e Cultura  
 * Bacharelado em Sistemas de Informação  
 * Programação para Web II 
 * Prof. Pablo Ricardo Roxo Silva 
 * Guilherme da Silva Menezes
 */

<?php
namespace App\Http\Controllers;

use App\Models\Artigo as Artigo;
use App\Http\Resources\Artigo as ArtigoResource;
use Illuminate\Http\Request;

class ArtigoController extends Controller
{
   
    public function index()
    {
        $artigos = Artigo::paginate(10);
        return ArtigoResource::collection($artigos);
    }
    public function store(Request $request)
    {
        $artigo = new Artigo;
        $artigo->titulo = $request->input('titulo');
        $artigo->tema = $request->input('tema');
        $artigo->conteudo = $request->input('conteudo');
        $artigo->imagem = $request->input('imagem');
        $artigo->criador = $request->input('criador');
        

        if( $artigo->save() ){
          return new ArtigoResource( $artigo );
        }
    }

    public function show($id)
    {
        $artigo = Artigo::findOrFail( $id );
        return new ArtigoResource( $artigo );
    }

    public function update(Request $request, $id)
    {
        $artigo = Artigo::findOrFail( $request->id );
        $artigo->titulo = $request->input('titulo');
        $artigo->tema = $request->input('tema');
        $artigo->conteudo = $request->input('conteudo');
        $artigo->imagem = $request->input('imagem');
        $artigo->criador = $request->input('criador');

        if( $artigo->save() ){
          return new ArtigoResource( $artigo );
        }
    }

    public function destroy($id)
    {
        $artigo = Artigo::findOrFail( $id );
        if( $artigo->delete() ){
          return new ArtigoResource( $artigo );
        }
    }
}