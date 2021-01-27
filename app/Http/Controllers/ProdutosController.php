<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // $produtos = Produto::all();
        $produtos = Produto::paginate(4);
        $busca = NULL;
    	// Enviando dados pra view produtos
        return view('produto.index', compact('produtos','busca'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Validadando usuário logado
        if (Auth::check()) {
            return view('produto.create');
        }else{
            return redirect('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validadando usuário logado
        if (Auth::check()) {

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
        }else{
            return redirect('login');
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
        // Validadando usuário logado
        if (Auth::check()) {
            $produto = Produto::find($id);
            return view('produto.edit', compact('produto'));
        }else{
            return redirect('login');
        }
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
        // Validadando usuário logado
        if (Auth::check()) {

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
        }else{
            return redirect('login');
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
        // Validadando usuário logado
        if (Auth::check()) {
            $produto = Produto::find($id);
            $produto->delete();
            Session::flash('mensagem', 'Produto excluido com sucesso!');
            return redirect()->back();
        }else{
            return redirect('login');
        }
    }

    /**
     * Displays the search feature
     *
     * @param string $busca
     * @author Junior Lima
     **/
    public function buscar(Request $request)
    {
        $produtos = Produto::where('titulo', 'LIKE', '%'. $request->input('busca'). '%')->orwhere('descricao', 'LIKE', '%'. $request->input('busca'). '%')->paginate(4);
        $busca = $request->input('busca');

        return view('produto.index', compact('produtos', 'busca'));
    }
}
