<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Str;
use Image;
use Session;

class CategoriaController extends Controller
{
    public function index(){
        $categorias = Categoria::all();
        return view("admin.categoria.index",compact('categorias'));
    }
    public function create(){
        return view("admin.categoria.create");
    }
    public function store(Request $request){
        
        $categoria = new Categoria($request->all());
        
        if($request->hasFile('urlfoto')){

            $imagen = $request->file('urlfoto');
            $nuevonombre = Str::slug($request->nombre).'.'.$imagen->guessExtension();
            Image::make($imagen->getRealPath())
            ->resize(1024,null,function($constraint){ $constraint->aspectRatio();  })
            ->save( public_path('/img/categoria/'.$nuevonombre));

            $registro->urlfoto = $nuevonombre;
        }
        $categoria->slug = Str::slug($request->nombre);
        $categoria->save();
        return redirect('/admin/categoria');

    }
    public function update(Request $request,$id){

        $categoria = Categoria::findOrFail($id);
        $categoria->fill($request->all());
        $foto_anterior = $categoria->urllogo;

        if($request->hasFile('urlfoto')){

            $rutaAnterior = public_path('/img/categoria/'.$foto_anterior);
            if(file_exists($rutaAnterior)){ unlink(realpath($rutaAnterior)); }

            $imagen = $request->file('urlfoto');
            $nuevonombre = Str::slug($request->nombre).'.'.$imagen->guessExtension();
            Image::make($imagen->getRealPath())
            ->resize(1024,null,function($constraint){ $constraint->aspectRatio();  })
            ->save( public_path('/img/categoria/'.$nuevonombre));

            $categoria->urlfoto = $nuevonombre;
        }
        $categoria->slug = Str::slug($request->nombre);
        $categoria->save();
        return redirect('/admin/categoria');
    }
    public function edit($id){
        $categoria = Categoria::findOrFail($id);
        return view('admin.categoria.edit',compact('categoria'));
    }
    public function show($id){
        Session::put('categoria_id',$id);
        return redirect('/admin/producto');
        //return view('admin.categoria.create');
    }
    public function destroy($id){
        $categoria = Categoria::findOrFail($id);
        $borrar = public_path('/img/categoria/'.$categoria->urlfoto);
        if(file_exists($borrar)){ unlink(realpath($borrar)); }

        $categoria->delete();

        return redirect('/admin/categoria');
    }
}

