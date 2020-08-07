<?php

namespace LaraDev\Http\Controllers;


use Illuminate\Http\Request;
use LaraDev\Http\Controllers\Controller;
use LaraDev\Model\Propriedade;

class propriedadeController extends Controller
{
    /**
     * Função que lista todas as Propriedades
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function index()
    {
        $propiedades = Propriedade::all();
        $titulo = "Lista Propriedade";
        return view("propriedade.index", [
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
        $propriedade = Propriedade::where('uri', $uri)->first();

        $titulo = "Propriedade";
        if (!empty($propriedade)) {
            return view("propriedade/listar", [
                "propriedade" => $propriedade,
                "titulo" => $titulo,
            ]);
        } else {
            return redirect()->action('propriedadeController@Index');
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
        return view("propriedade.create", [
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

        Propriedade::create($propriedade);

        return redirect()->action('propriedadeController@index');
    }

    public function editar($uri)
    {
        $propriedade = Propriedade::where('uri', $uri)->first();

        $titulo = "Editar Propriedade";
        if (!empty($propriedade)) {
            return view("propriedade/editar", [
                "propriedade" => $propriedade,
                "titulo" => $titulo,
            ]);
        } else {
            return redirect()->action('propriedadeController@Index');
        }
    }

    public function alterar(Request $request, $id)
    {
        $propriedadeSlug = $this->setUri($request->titulo);

        $propriedade = Propriedade::find($id);

        $propriedade->titulo = $request->titulo;
        $propriedade->uri = $propriedadeSlug;
        $propriedade->descricao = $request->descricao;
        $propriedade->preco_rentavel = $request->preco_rentavel;
        $propriedade->preco_venda = $request->preco_venda;

        $propriedade->save();

        return redirect()->action('propriedadeController@index');
    }

    public function excluir($uri)
    {
        $propriedade = Propriedade::where('uri', $uri)->first();

        if(!empty($propriedade)){
            $propriedade->delete();
        }

        return redirect()->action('propriedadeController@index');
    }

//    public function limparCampos(Request $request)
//    {
//        $request->titulo = "";
//        $request->descricao = "";
//        $request->preco_rentavel = "";
//        $request->preco_venda = "";
//
//
//    }

    public function formatarMoeda($valor)
    {
        return "R$ " . number_Format($valor, 2, ',', '.');
    }

    /**
     * Função para criar uma nova propriedade
     *
     * @param $request
     * @return Propriedade
     */
    private function novo($request)
    {
        $propriedadeSlug = $this->setUri($request->titulo);

        $propriedade = new Propriedade();

//        $propriedade->titulo = $request->titulo;
//        $propriedade->uri = $propriedadeSlug;
//        $propriedade->descricao = $request->descricao;
//        $propriedade->preco_rentavel = $request->preco_rentavel;
//        $propriedade->preco_venda = $request->preco_venda;

        $propriedade = [
          'titulo' =>  $request->titulo,
          'uri' =>  $propriedadeSlug,
          'descricao' =>  $request->descricao,
          'preco_rentavel' =>  $request->preco_rentavel,
          'preco_venda' =>  $request->preco_venda,
        ];

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

        $propriedades = Propriedade::all();

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
