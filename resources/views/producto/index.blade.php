@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Productos Agropecuarios</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Barra de búsqueda y filtros -->
    <form action="{{ route('producto.index') }}" method="GET" class="mb-3 d-flex">
        <input type="text" name="search" class="form-control me-2" placeholder="Buscar producto...">
        <select name="categoria" class="form-select me-2">
            <option value="">Todas las categorías</option>
            <option value="Grano">Grano</option>
            <option value="Leguminosa">Leguminosa</option>
            <option value="Hortaliza">Hortaliza</option>
            <option value="Fruta">Fruta</option>
            <option value="Animal">Animal</option>
        </select>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <!-- Botón para agregar producto -->
    <a href="{{ route('producto.create') }}" class="btn btn-success mb-3">Agregar Producto</a>

    <!-- Tabla de productos -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><a href="{{ route('producto.index', ['sort' => 'nombre']) }}">Nombre</a></th>
                <th>Categoría</th>
                <th><a href="{{ route('producto.index', ['sort' => 'precio']) }}">Precio</a></th>
                <th><a href="{{ route('producto.index', ['sort' => 'cantidad']) }}">Cantidad</a></th>
                <th>Foto</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->categoria }}</td>
                <td>${{ $producto->precio }}</td>
                <td>
                    {{ $producto->cantidad }}
                    @if($producto->cantidad < 20)
                        <span class="badge bg-danger">Stock bajo</span>
                    @endif
                </td>
                <td>
                    @if($producto->foto)
                        <img src="{{ asset('storage/'.$producto->foto) }}" width="80">
                    @endif
                </td>
                <td>{{ $producto->descripcion }}</td>
                <td>
                    <!-- Botón Ver dentro del foreach -->
                    <a href="{{ route('producto.show', $producto->id) }}" class="btn btn-info">Ver</a>
                    <a href="{{ route('producto.edit', $producto->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('producto.destroy', $producto->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    {{ $productos->links() }}
</div>
@endsection
