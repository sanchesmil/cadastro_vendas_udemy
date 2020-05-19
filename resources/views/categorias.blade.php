@extends('layouts.app' , ['urlAtual'=>'categorias'])

@section('body')
    <h4>Página de Categorias</h4>
    <hr>

    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Categorias</h5>

            @if(isset($categorias) && count($categorias))   {{--Verifica se existe a variável $categoria e se não está vazia --}}
                <table class="table table-ordered table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome da Categoria</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                            <tr>
                                <td>{{$categoria->id}}</td>
                                <td>{{$categoria->nome}}</td>
                                <td>
                                    <a href="/categorias/editar/{{$categoria->id}}" class="btn btn-primary btm-sm">Editar</a>
                                    <a href="/categorias/apagar/{{$categoria->id}}" class="btn btn-danger btm-sm">Apagar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="card-footer">
            <a href="/categorias/novo" class="btn btn-primary btn-sm" role="button">Nova Categoria</a>
        </div>
    </div>
@endsection