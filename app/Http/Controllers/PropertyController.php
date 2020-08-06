<?php

namespace LaraDev\Http\Controllers;


use Illuminate\Http\Request;
use LaraDev\Http\Controllers\Controller;
use LaraDev\Model\Property;

class PropertyController extends Controller
{
    /**
     * Função que lista todas as Propriedades
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function index()
    {
        $propiedades = Property::all();
        $titulo = "Lista Propriedade";
        return view("property.index", [
            "propriedades" => $propiedades,
            "titulo" => $titulo,
        ]);
    }

    /**
     * Função para listar uma propriedade
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function listar($uri)
    {
        $property = Property::where('uri', $uri)->first();

        $titulo = "Propriedade";
        if (!empty($property)) {
            return view("property/listar", [
                "propriedade" => $property,
                "titulo" => $titulo,
            ]);
        } else {
            return redirect()->action('PropertyController@Index');
        }
    }

    /**
     * Função para carregar a tela para cadastrar uma propriedade
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function create()
    {
        $titulo = "Cadastro de Propriedade";
        return view("property.create", [
            "titulo" => $titulo
        ]);
    }

    /**
     * Função para salvar uma Propiedade
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvar(Request $request)
    {
        $propriedade = $this->novo($request);

        $propriedade->save();

        return redirect()->action('PropertyController@index');
    }

    public function editar($uri)
    {
        $property = Property::where('uri', $uri)->first();

        $titulo = "Editar Propriedade";
        if (!empty($property)) {
            return view("property/editar", [
                "propriedade" => $property,
                "titulo" => $titulo,
            ]);
        } else {
            return redirect()->action('PropertyController@Index');
        }
    }

    public function alterar(Request $request, $id)
    {
        $propriedadeSlug = $this->setUri($request->titulo);
        $property = Property::where('id', $id)->first();

        $property->titulo = $request->titulo;
        $property->uri = $propriedadeSlug;
        $property->descricao = $request->descricao;
        $property->preco_rentavel = $request->preco_rentavel;
        $property->preco_venda = $request->preco_venda;

        $property->save();

        return redirect()->action('PropertyController@index');
    }

    public function excluir($uri)
    {
        $property = Property::where('uri', $uri)->first();

        if(!empty($property)){
            $property->delete();
        }

        return redirect()->action('PropertyController@index');
    }

    public function formatarMoeda($valor)
    {
        return "R$ " . number_Format($valor, 2, ',', '.');
    }

    /**
     * Função para criar uma nova propriedade
     *
     * @param $request
     * @return Property
     */
    private function novo($request)
    {
        $propriedadeSlug = $this->setUri($request->titulo);

        $propriedade = new Property();

        $propriedade->titulo = $request->titulo;
        $propriedade->uri = $propriedadeSlug;
        $propriedade->descricao = $request->descricao;
        $propriedade->preco_rentavel = $request->preco_rentavel;
        $propriedade->preco_venda = $request->preco_venda;

        return $propriedade;
    }

    /**
     * Função que cria uma URL amígável
     *
     * @param $parametro
     * @return string
     */
    private function setUri($parametro)
    {
        $propriedadeSlug = str_slug($parametro);

        $propriedades = Property::all();

        $i = 0;

        foreach ($propriedades as $propriedade) {
            if (str_slug($propriedade->titulo) === $propriedadeSlug) {
                $i++;
            }
        }

        if ($i > 0) {
            $propriedadeSlug = "$propriedadeSlug-$i";
        }
        return $propriedadeSlug;
    }
}
