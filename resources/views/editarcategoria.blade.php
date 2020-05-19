@extends('layouts.app' , ['urlAtual'=>'categorias'])

@section('body')
    <h4>Página de Categorias</h4>
    <hr>

    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Editar Categoria</h5>
            @if(isset($categoria)) 
            <form action="/categorias/{{$categoria->id}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nomeCategoria">Nome da Categoria</label>
                    <input type="text" class="form-control" name="nomeCategoria" 
                          id="nomeCategoria" placeholder="Categoria" value="{{$categoria->nome}}">
    
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                <a href="/categorias" class="btn btn-danger btn-sm">Cancelar</a>
            </form>
            @endif
        </div>
    </div>

@endsection