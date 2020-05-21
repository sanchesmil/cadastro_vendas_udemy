@extends('layouts.app',['urlAtual'=>'produtos'])

@section('body')

    <h4>Página de Produtos</h4>
    <hr>

    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Produtos</h5>

            @if(isset($produtos) && count($produtos))   {{--Verifica se existe a variável $Produto e se não está vazia --}}
                <table class="table table-ordered table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Quantidade</th>
                            <th>Preço</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produtos as $produto)
                            <tr>
                                <td>{{$produto->id}}</td>
                                <td>{{$produto->nome}}</td>
                                <td>{{$produto->estoque}}</td>
                                <td>{{$produto->price}}</td>
                                <td>
                                    <a href="/produtos/editar/{{$produto->id}}" class="btn btn-primary btm-sm">Editar</a>
                                    <a href="/produtos/apagar/{{$produto->id}}" class="btn btn-danger btm-sm">Apagar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="card-footer">
            <a href="/produtos/novo" class="btn btn-primary btn-sm" role="button">Novo Produto</a>
        </div>
    </div>
@endsection