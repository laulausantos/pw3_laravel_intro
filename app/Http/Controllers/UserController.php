<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
/**
 * Exibe formulario de cadastro do usuario
 */

    public function create()
    {
        return view('users.create');
    }

    /**
     * Salvar o novo usuario no banco de dados de validação
     */
    public function store(Request $request)
    {
        //validação dos campos de formulario
        $dadosValidados = $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'passaword' => 'required|min:6'
        ]);

        //Persistencia no banco de dados usando ORM Eloquent
        User::create($dadosValidados);

        //Redirecionar para o painel administrativo com mensagem de sucesso
        return redirect('/admin')->with('sucesso','Usuario cadastrado com sucesso');
    }
    
}
