@extends('layouts.app' , ['urlAtual'=>'produtos'])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Editar Produto</h5>

        @if(isset($produto) && isset($categoria_prod) && isset($categorias))   {{--Verifica se existe a variável $Produto e se não está vazia --}}
            <form action="/produtos/{{$produto->id}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nomeProduto">Nome do Produto</label>
                    <input type="text" class="form-control" name="nomeProduto" 
                           id="nomeProduto" placeholder="Produto" value="{{$produto->nome}}">

                    <label for="estoque">Quantidade</label>
                    <input type="number" class="form-control" name="estoque" 
                           id="estoque"  value="{{$produto->estoque}}">

                    <label for="preco">Preço</label>
                    <input type="number" step="any" class="form-control" name="preco" 
                           id="preco"  value="{{$produto->price}}">

                    <label for="categoria_id">Categoria</label>
                    <select class="form-control" id="categoria_id" name="categoria_id">
                        <option value="{{$categoria_prod->id}}">{{$categoria_prod->nome}}</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                <a href="/produtos" class="btn btn-danger btn-sm">Cancelar</a>
            </form>
        @endif
        </div>
    </div>

@endsection