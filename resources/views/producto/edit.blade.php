@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Producto</h1>
    <form action="{{ route('producto.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('producto.form')
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('producto.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
