@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.submenu')
        <div class="col-sm-10">
            <a href="{{route('categoria.create')}}" class="btn btn-success">NUEVO</a>
            <table class="table table-striped">
                <thead>
                    <th>Orden</th>
                    <th>Nombre</th>
                    <th>Accion</th>
                </thead>
                <tbody>
                    @forelse($categorias as $item)
                    <tr>
                        <td>{{$item->orden}}</td>
                        <td>{{$item->nombre}}</td>
                        <td>
                            <a href="{{route('categoria.show',$item->id)}}" class="btn btn-success">PRODUCTOS</a>
                            <a href="{{route('categoria.edit',$item->id)}}" class="btn btn-success">EDITAR</a>
                            {!! Form::open(['method'=>'DELETE','route'=>['categoria.destroy',$item->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('ELIMINAR',['class'=>'btn btn-success','onclick'=>'return confirm("ESTA SEGURO DE ELIMINAR ?")']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection