@extends('layouts.app', ['urlAtual'=>'produtos'])

@section('body')

<div class="car border">
    <div class="card-body">
        <h5 class="card-title">Cadastro de Produtos</h5>

        @if(!isset($categorias) or !count($categorias))   {{--Verifica se existe a variável $Produto e se não está vazia --}}
            <hr>    
            <h4 class="card-title">Cadastre uma categoria antes de prosseguir.</4>
        @else
            <form action="/produtos" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nomeProduto">Nome do Produto</label>
                    <input type="text" class="form-control" name="nomeProduto" id="nomeProduto" placeholder="Produto">

                    <label for="estoque">Quantidade</label>
                    <input type="number" class="form-control" name="estoque" id="estoque" value='0'>

                    <label for="preco">Preço</label>
                    <input type="number" step="any" class="form-control" name="preco" id="preco" value='0.0'>

                    <label for="categoria_id">Categoria</label>
                    <select class="form-control" id="categoria_id" name="categoria_id">
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