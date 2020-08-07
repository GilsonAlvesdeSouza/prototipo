@extends("layout")

@section("cabecalho")
    Alterar Propriedades
@endsection

@section("conteudo")

    <form action="{{url("/imoveis/alterar", ['id' =>$propriedade->id])}}" method="post">
        <div class="form-group">


            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <label for="titulo">Titulo do Imóvel: </label>
            <input type="text" name="titulo" id="titulo" value="{{$propriedade->titulo}}" class="form-control"><br>

            <label for="descricao">Descrição: </label>
            <textarea type="text-area" name="descricao" id="descricao" class="form-control" cols="30"
                      rows="3">{{$propriedade->descricao}}</textarea><br>

            <label for="preco-rentavel">Preço Rentavel: </label>
            <input type="text" name="preco_rentavel" id="preco_rentavel" value="{{ $propriedade->preco_rentavel }}"
                   class="form-control"><br>

            <label for="preco_venda">Preço de Venda: </label>
            <input type="number" name="preco_venda" id="preco_venda" value="{{ $propriedade->preco_venda }}"
                   class="form-control"><br>

            <button type="submit" class="btn btn-primary"  style="margin: 10px">Alterar</button>

            <a href="{{ url("/imoveis") }}"> <input  type="button" value="Voltar" class="btn btn-info"  style="margin: 10px" /> </a>
        </div>
    </form>
@endsection
