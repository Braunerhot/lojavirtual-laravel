@extends('site.layout')
@section('title', 'HOME')
@section('conteudo')

<div class="row container">

    @foreach ($produtos as $produto)
        <div class="col s12 m4">
            <div class="card">
                <div class="card-image">
                    <img src="{{ $produto->imagem }}">
                    <a href="{{ route('site.details', $produto->slug) }}" class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">visibility</i></a>
                </div>
                <div class="card-content">
                    <span class="card-title">{{ "Nome: ".Str::limit($produto->nome, 15) }}</span>
                    <p>{{ "Descrição: ".Str::limit($produto->descricao, 20) }}</p>
                    <p>{{ "Preço: R$ " .$produto->preco }}</p>
                </div>
            </div>
        </div>
    @endforeach
    <div class="row center">
        <span> {{ $produtos->links('custom.pagination') }} </span>
    </div>

</div>



@endsection