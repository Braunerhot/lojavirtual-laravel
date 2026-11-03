<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function carrinhoLista(){
        $itens = \Cart::getContent();
        return view('site.carrinho', compact('itens'));
    }

    public function carrinhoAdicionar(Request $request){
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => abs($request->qnt),
            'attributes' => array(
                'image' => $request->img
            )
        ]);

        return redirect()->route('site.carrinho')->with('Sucesso', 'Produto adicionado no carrinho com sucesso!');
    }

    public function carrinhoRemove(Request $request){
        \Cart::remove($request->id);
        return redirect()->route('site.carrinho')->with('Aviso', 'Produto removido do carrinho com sucesso!');
    }

    public function carrinhoAtualiza(Request $request){
        \Cart::update($request->id, ['quantity' => ['relative' => false,'value' => abs($request->quantity),]]);
        return redirect()->route('site.carrinho')->with('Sucesso', 'Produto atualizado no carrinho com sucesso!');
    }

    public function carrinhoLimpar(){
        \Cart::clear();
        return redirect()->route('site.carrinho')->with('Aviso', 'Seu carrinho está vazio!');
    }

}
