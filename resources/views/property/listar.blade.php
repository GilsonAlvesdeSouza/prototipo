@extends("layout")

@section("cabecalho")
    Página Single
@endsection

@section("conteudo")
    @if(!empty($propriedade))
        <h2>Título do Imóvel: </h2><p>{{ $propriedade->titulo }}</p>
        <h3>Descrição: </h3><p>{{ $propriedade->descricao }}</p>
        <h3>Valor de Locação: </h3><p>{{ app(LaraDev\Http\Controllers\PropertyController::class)->formatarMoeda($propriedade->preco_rentavel)}}</p>
        <h3>Valor de Venda: </h3><p>{{ app(LaraDev\Http\Controllers\PropertyController::class)->formatarMoeda($propriedade->preco_venda)}}</p>
        {{$titulo}}
    @endif

@endsection
