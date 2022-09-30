<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carrusel;
use Illuminate\Support\Str;
use Image;

class CarruselController extends Controller
{
    
    
    public function index(){
        $carrusels = Carrusel::all();
        return view("admin.carrusel.index",compact('carrusels'));
    }
    public function create(){
        return view('admin.carrusel.create');
    }
    public function store(Request $request){

        $carrusel = new carrusel($request->all());
        
        if($request->hasFile('urlfoto')){

            $imagen = $request->file('urlfoto');
            $nuevonombre = 'artesanias_'.time().'.'.$imagen->guessExtension();
            Image::make($imagen->getRealPath())
            ->fit(1200,450,function($constraint){ $constraint->upsize();  })
            ->save( public_path('/img/carrusel/'.$nuevonombre));

            $carrusel->urlfoto = $nuevonombre;
        }
        $carrusel->save();
        return redirect('/admin/carrusel');

    }
    public function update(Request $request,$id){

        $carrusel = carrusel::findOrFail($id);
        $carrusel->fill($request->all());
        $foto_anterior     = $carrusel->urlfoto;


        if($request->hasFile('urlfoto')){

            $rutaAnterior = public_path('/img/carrusel/'.$foto_anterior);
            if(file_exists($rutaAnterior)){ unlink(realpath($rutaAnterior)); }

            $imagen = $request->file('urlfoto');
            
            $nuevonombre = 'artesanias_'.time().'.'.$imagen->guessExtension();
            Image::make($imagen->getRealPath())
            ->fit(1200,450,function($constraint){ $constraint->upsize();  })
            ->save( public_path('/img/carrusel/'.$nuevonombre));

            $carrusel->urlfoto = $nuevonombre;
        }
       
        $carrusel->save();
        return redirect('/admin/carrusel');
    }

    public function edit($id){
        $carrusel = carrusel::findOrFail($id);
        return view('admin.carrusel.edit',compact('carrusel'));
    }

    public function destroy($id){
        $carrusel = carrusel::findOrFail($id);
        $borrar = public_path('/img/carrusel/'.$carrusel->urlfoto);
        if(file_exists($borrar)){ unlink(realpath($borrar)); }
        $carrusel->delete();
        return redirect('/admin/carrusel');
    }
}