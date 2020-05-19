<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Produto;
use Illuminate\Http\Request;

class ControladorProduto extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::all();

        return view('produtos', compact('produtos'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produto = new Produto();
        $produto->nome = $request->nomeProduto;
        $produto->estoque = $request->estoque;
        $produto->price = $request->preco;
        $produto->categoria_id = $request->categoria_id;

        $produto->save();

        return redirect('/produtos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produto = Produto::find($id);
     
        if(isset($produto)){
            $produto->nome = $request->nomeProduto;
            $produto->estoque = $request->estoque;
            $produto->price = $request->preco;
            $produto->categoria_id = $request->categoria_id;

            $produto->save();
        }

        return redirect('/produtos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Produto::find($id);

        if($produto)
            $produto->delete();  // No caso do produto é SoftDelete

        return redirect('/produtos');
    }
}

