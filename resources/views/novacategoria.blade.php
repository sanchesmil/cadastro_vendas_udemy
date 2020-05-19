@extends('layouts.app', ['urlAtual'=>'categorias'])

@section('body')

<div class="car border">
    <div class="card-body">
        <form action="/categorias" method="POST">
            @csrf
            <div class="form-group">
                <label for="nomeCategoria">Nome da Categoria</label>
                <input type="text" class="form-control" name="nomeCategoria" id="nomeCategoria" placeholder="Categoria">

            </div>
            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
            <a href="/categorias" class="btn btn-danger btn-sm">Cancelar</a>
        </form>
    </div>
</div>

@endsection