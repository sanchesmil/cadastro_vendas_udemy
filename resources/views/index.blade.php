@extends('layouts.app', ['urlAtual'=>'home'])

@section('body')

<div class="jumbotron bg-light border border-secondary">
    <div class="row">
        <div class="card-deck">
            <div class="card border border-primary">
                <div class="card-body">
                    <h5 class="card-title">Cadastro de Produtos</h5>
                    <p class="card-text">
                        Aqui você cadastra seus produtos!!!
                    </p>
                    <a href="/produtos" class="btn btn-primary">Cadastre os produtos</a>
                </div>  
            </div>
            <div class="card border border-primary">
                <div class="card-body">
                    <h5 class="card-title">Cadastro de Categorias</h5>
                    <p class="card-text">
                        Aqui você cadastra seus categorias!!!
                    </p>
                    <a href="/categorias" class="btn btn-primary">Cadastre as Categorias</a>
                </div>  
            </div>
        </div>
    </div>
</div>

@endsection