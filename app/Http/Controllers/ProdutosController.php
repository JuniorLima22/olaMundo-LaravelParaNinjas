<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use\App\Requests;
use App\Produto;
use Session;

class ProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::all();
    	// dd($produtos);
    	// Enviando dados pra view produtos
    	// return view('produto.index', array('produtos' => $produtos ));
        return view('produto.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validadando dados do formulário
        $this->validate($request, [
          'referencia' => 'required|unique:produtos|min:3',
          'titulo' => 'required|min:3',
        ]);

        // Cadastrando produto
        $produto = new Produto();
        $produto->referencia = $request->input('referencia');
        $produto->titulo = $request->input('titulo');
        $produto->descricao = $request->input('descricao');
        $produto->preco = $request->input('preco');
        if ($produto->save()) {
            Session::flash('mensagem', 'Produto cadastrado com sucesso!');
            return redirect('produtos');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = Produto::find($id);
        return view('produto.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = Produto::find($id);
        return view('produto.edit', compact('produto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validadando dados do formulário
        $this->validate($request, [
            'referencia' => 'required|min:3',
            'titulo' => 'required|min:3',
        ]);

        if ($request->hasFile('fotoproduto')) {
          $imagem = $request->file('fotoproduto');
          $nomeArquivo = md5($id). ".". $imagem->getClientOriginalExtension();
          $request->file('fotoproduto')->move(public_path('./img/produtos/'), $nomeArquivo);
        }

        $produto = Produto::find($id);
        $produto->referencia = $request->input('referencia');
        $produto->titulo = $request->input('titulo');
        $produto->descricao = $request->input('descricao');
        $produto->preco = $request->input('preco');

        if ($produto->save()) {
            Session::flash('mensagem', 'Produto alterado com sucesso!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Produto::find($id);
        $produto->delete();
        Session::flash('mensagem', 'Produto excluido com sucesso!');
        return redirect()->back();
    }
}
