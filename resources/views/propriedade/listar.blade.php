@extends("layout")

@section("cabecalho")
    Página Single
@endsection

@section("conteudo")
    @if(!empty($propriedade))
        <h2>Título do Imóvel: </h2><p>{{ $propriedade->titulo }}</p>
        <h3>Descrição: </h3><p>{{ $propriedade->descricao }}</p>
        <h3>Valor de Locação: </h3><p>{{ app(LaraDev\Http\Controllers\propriedadeController::class)->formatarMoeda($propriedade->preco_rentavel)}}</p>
        <h3>Valor de Venda: </h3><p>{{ app(LaraDev\Http\Controllers\propriedadeController::class)->formatarMoeda($propriedade->preco_venda)}}</p>
        <a href="{{ url("/imoveis") }}"> <input  type="button" value="Voltar" class="btn btn-info"  style="margin: 10px" /> </a>
    @endif

@endsection
