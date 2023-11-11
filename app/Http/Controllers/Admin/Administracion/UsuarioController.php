<?php

namespace App\Http\Controllers\Admin\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rol;
use Brian2694\Toastr\Facades\Toastr;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::where('IdEstado', 1)->where('IdRol', '<>', 1)->get();
        //dd($usuarios);
        return view('admin.administracion.usuarios.index')->with('usuarios', $usuarios);
    }

    public function create()
    {
        $usuario = new User;

        $roles = Rol::where('IdRol', '<>', 1)->orderBy('DescripcionRol')->get();
        
        return view('admin.administracion.usuarios.create')->with('usuario', $usuario)->with('roles', $roles);
    }

    public function store(Request $request)
    {
        
        $usuario = new User();
        $usuario->IdRol = $request->id_rol;
        $usuario->IdEstado = 1;
        $usuario->NombreCompleto = $request->nombres;
        $usuario->Usuario = strtoupper($request->usuario);
        $usuario->Password = $request->password;
        $usuario->save();

        Toastr::success('Usuario registrado satisfactoriamente.', 'Sistemas Análiticos Generales');
        return redirect('/admin/administracion/usuario');
    }

    public function edit($id)
    {
        $usuario = User::find($id);

        $roles = Rol::where('IdRol', '<>', 1)->orderBy('DescripcionRol')->get();
        
        return view('admin.administracion.usuarios.edit')->with('usuario', $usuario)->with('roles', $roles);
    }

    public function update($id, Request $request)
    {
        $usuario = User::find($id);
        $usuario->IdRol = $request->id_rol;
        $usuario->IdEstado = 1;
        $usuario->NombreCompleto = $request->nombres;
        $usuario->Usuario = strtoupper($request->usuario);
        $usuario->Password = $request->password;
        $usuario->save();

        Toastr::success('Usuario actualizado satisfactoriamente.', 'Sistemas Análiticos Generales');
        return redirect('/admin/administracion/usuario');
    }

    public function delete($id, Request $request)
    {
        dd($id);
        $usuario = User::find($id);
        $usuario->IdEstado = 2;
        $usuario->save();

        Toastr::success('Usuario eliminado satisfactoriamente.', 'Sistemas Análiticos Generales');
        return redirect('/admin/administracion/usuario');
    }
}
