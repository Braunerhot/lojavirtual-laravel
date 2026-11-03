@extends('site.layout')
@section('title', 'Carrinho')
@section('conteudo')

<div class="row container">

    @if ($mensagem = Session::get('Sucesso'))
      <div class="card green">
        <div class="card-content white-text">
          <span class="card-title">Parabéns!</span>
          <p>{{ $mensagem }}</p>
        </div>
      </div>
    @endif

    @if ($mensagem = Session::get('Aviso'))
      <div class="card orange">
        <div class="card-content black-text">
          <span class="card-title">Aviso!</span>
          <p>{{ $mensagem }}</p>
        </div>
      </div>
    @endif

    @if ($itens->count() == 0)
      <div class="card orange">
        <div class="card-content black-text">
          <span class="card-title">Seu carrinho está vazio!</span>
          <p>Aproveite nossas promoções.</p>
        </div>
      </div>
    @else
      <h5>Seu carrinho possui {{$itens->count()}} produtos.</h5>
      <table class="striped">
        <thead>
          <tr>
              <th>Imagem</th>
              <th>Nome</th>
              <th>Preco</th>
              <th>Quantidade</th>
              <th></th>
          </tr>
        </thead>

        <tbody>
          @foreach ($itens as $item)
          <tr>
            <td><img src="{{$item->attributes->image}}" alt="" width="70" class="responsive-img circle"></td>
            <td>{{$item->name}}</td>
            <td>R$ {{ number_format($item->price, 2, ',', '.') }}</td>
            <td>
                {{-- BTN Atualizar --}}
                <form action="{{ route('site.atualizacarrinho') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id" value="{{ $item->id }}">
                  <input style="width: 40px; font-weight: 900;" class="white center" min="1" type="number" name="quantity" value="{{$item->quantity}}">
                  <button class="btn-floating waves-effect waves-light orange"><i class="material-icons">refresh</i></button>
                </form>
            </td>
            <td>
                {{-- BTN Remover --}}
                <form action="{{ route('site.removecarrinho') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id" value="{{ $item->id }}">
                  <button class="btn-floating waves-effect waves-light red"><i class="material-icons">delete</i></button>
                </form>
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
    
    <div class="card orange">
      <div class="card-content white-text">
        <span class="card-title">Valor Total: R$ {{ number_format(\Cart::getTotal(), 2, ',', '.') }}</span>
        <p>Pague em 12x sem Juros.</p>
      </div>
    </div>

    @endif

      <div class="row container center">
        {{-- BTN Continuar --}}
        <a href="{{ route('site.index') }}" class="btn waves-effect waves-light blue"> Continuar Comprando <i class="material-icons right">arrow_back</i></a>
        {{-- BTN Limpar --}}
        <a href="{{ route('site.limparcarrinho') }}" class="btn waves-effect waves-light blue"> Limpar Carrinho <i class="material-icons right">clear</i></a>
        <button class="btn waves-effect waves-light green"> Finalizar Pedido <i class="material-icons right">check</i></button>
      </div>

</div>

@endsection