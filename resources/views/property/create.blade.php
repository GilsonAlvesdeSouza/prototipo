@extends("layout")

@section("cabecalho")
    Cadastrar Propriedades
@endsection

@section("conteudo")
    <form action="{{url("/imoveis/salvar")}}" method="post">
        <div class="form-group">

            {{csrf_field()}}

            <label for="titulo">Titulo do Imóvel: </label>
            <input type="text" name="titulo" id="titulo" class="form-control" ><br>

            <label for="descricao">Descrição: </label>
            <textarea type="text-area" name="descricao" id="descricao" class="form-control" cols="30" rows="3" ></textarea><br>

            <label for="preco-rentavel">Preço Rentavel: </label>
            <input type="number" name="preco_rentavel" id="preco_rentavel" class="form-control" ><br>

            <label for="preco_venda">Preço de Venda: </label>
            <input type="number" name="preco_venda" id="preco_venda" class="form-control" ><br>

            <button type="submit" class="btn btn-primary">Salvar</button>

        </div>
    </form>
@endsection
