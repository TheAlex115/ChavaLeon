@extends('layouts.app')
@section('content')
<div class="container">


@if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
@endif
<a href="{{ url('empleado/create') }}" class="btn btn-success">Registrar nuevo empleado</a>
 
<table class="table table-light">
  <thead class="thead-light">
    <tr>
      <th>#</th>
      <th>Nombre</th>
      <th>Apellido Paterno</th>
      <th>Apellido Materno</th>
      <th>Correo</th>
      <th>Foto</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($empleados as $empleado)
      <tr>
        <td>{{ $empleado->id }}</td>

        <td>

         <img class="img-thumbnail img-fluid" src="{{ asset('storage/'.$empleado->foto) }}" width="50">

          {{ $empleado->nombre }}
        </td>

        <td>{{ $empleado->apellido_paterno }}</td>
        <td>{{ $empleado->apellido_materno }}</td>
        <td>{{ $empleado->email }}</td>
        <td>
          <img class="img-thumbnail img-fluid" src="{{ asset('storage/'.$empleado->foto) }}" width="100">
        </td>
        <td>
          <!-- Botones de acción -->
          <a href="{{ url('/empleado/'.$empleado->id.'/edit') }}" class="btn btn-warning">Editar</a>
          
          <form action="{{ url('/empleado/'.$empleado->id) }}" method="post" style="display:inline"
                onsubmit="return confirm('¿Estás seguro de eliminar este empleado?');">
            @csrf
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-danger">Eliminar</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
{{ $empleados->links() }}
</div>
@endsection 