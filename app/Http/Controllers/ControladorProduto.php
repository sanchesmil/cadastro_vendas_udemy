<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Produto;
use Illuminate\Http\Request;

class ControladorProduto extends Controller
{
  
    public function indexView()
    {
        return view('produtos');
    }

    // Retorna 'produtos' no formato Json
    public function index(){
        $produtos = Produto::all();
        return $produtos->toJson();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();

        return view('novoproduto', compact('categorias'));
    }

   // Retorna um recurso 'produto'
    public function store(Request $request)
    {
        $produto = new Produto();
        $produto->nome = $request->nome;
        $produto->estoque = $request->estoque;
        $produto->price = $request->preco;
        $produto->categoria_id = $request->categoria_id;

        $produto->save();

        return json_encode($produto);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = Produto::find($id); 
        if(isset($produto)){
            return json_encode($produto);
        }       
        return response("Produto não encontrado", 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = Produto::find($id);   // Recupera o produto

        $categoria_id = $produto->categoria_id;
        $categoria_prod = Categoria::find($categoria_id);  // Recupera a categoira do produto

        $categorias = Categoria::all();   //Recupera todas as categorias

        if(isset($produto) and isset($categorias)){
            return view('editarproduto', compact('produto','categoria_prod','categorias'));
        }else{
            return redirect('/produtos');
        }
       
    }

    // Atualiza e retorna o produto no formato JSON 
    public function update(Request $request, $id)
    {
        $produto = Produto::find($id);
     
        if(isset($produto)){
            $produto->nome = $request->nome;
            $produto->estoque = $request->estoque;
            $produto->price = $request->preco;
            $produto->categoria_id = $request->categoria_id;

            $produto->save();

            return json_encode($produto);
        }       
        return response("Produto não encontrado", 404);
    }

   // Remove o produto
    public function destroy($id)
    {
        $produto = Produto::find($id);

        if(isset($produto)){
            $produto->delete();  // No caso do produto, é SoftDelete
            return response("OK", 200); 
        }
        return response("Produto não encontrado", 404);
    }

}

