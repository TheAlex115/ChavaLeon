@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Producto</h1>
    <form action="{{ route('producto.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('producto.form')
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('producto.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
