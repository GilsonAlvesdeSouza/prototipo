<?php

namespace LaraDev\Http\Controllers;


use Illuminate\Http\Request;
use LaraDev\Http\Controllers\Controller;
use LaraDev\Model\Property;

class PropertyController extends Controller
{
    public function index()
    {
       $propiedades = Property::all();
        $titulo = "Lista Propriedade";
       return view("property.index",[
           "propriedades" => $propiedades,
           "titulo" => $titulo,
        ]);
    }

    public function listar($id)
    {
        $property = Property::find($id);
        $titulo = "Propriedade";
        if(!empty($property)){
            return view("property/listar", [
                "propriedade" => $property,
                "titulo" => $titulo,
            ]);
        }else{
            return redirect()->action('PropertyController@Index');
        }
    }

    public function create()
    {
        $titulo = "Cadastro de Propriedade";
     return view("property.create", [
         "titulo" => $titulo
     ]);
    }

    public function salvar(Request $request)
    {
        $propriedade = new Property();
        $propriedade->titulo = $request->titulo;
        $propriedade->descricao = $request->descricao;
        $propriedade->preco_rentavel = $request->preco_rentavel;
        $propriedade->preco_venda = $request->preco_venda;
        $propriedade->save();

      return redirect()->action('PropertyController@index');
    }

    public function formatarMoeda($valor){
        return "R$ ". number_Format($valor, 2, ',', '.' );
    }
}
