

   <h1>{{$modo}} Empleado</h1> 
    <br>


     @if(count($errors)>0)
     <div class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
            @endforeach
        </ul>
     </div>
     @endif


    <div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control" name="nombre" 
    value="{{ isset($empleado->nombre) ? $empleado->nombre : old('nombre') }}" id="nombre">
    <br>


</div>

<div class="form-group">
    <label for="apellido_paterno">Apellido Paterno</label>
    <input type="text" class="form-control" name="apellido_paterno" 
    value="{{ isset($empleado->apellido_paterno) ? $empleado->apellido_paterno : old('apellido_paterno') }}"  id="apellido_paterno">
    <br>
</div>

<div class="form-group">
    <label for="apellido_materno">Apellido Materno</label>
    <input type="text" class="form-control" name="apellido_materno" 
    value="{{ isset($empleado->apellido_materno) ? $empleado->apellido_materno : old('apellido_materno') }}" id="apellido_materno">
    <br>

</div>

<div class="form-group">
    <label for="email">Correo</label>
    <input type="email" class="form-control" name="email" 
    value="{{ isset($empleado->email) ? $empleado->email : old('email') }}" id="email">
    <br>

</div>

<div class="form-group">
    <label for="foto"></label>
    @if(isset($empleado->foto))
    <img class="img-thumbnail img-fluid"src="{{ asset('storage/'.$empleado->foto) }}" width="100">
    @endif  
    <input type="file" class="form-control" name="foto" value="" id="foto">
    <br>

</div>

    <button class="btn btn-success" type="submit">{{$modo}} Datos</button>
      
    <a class="btn btn-primary" href="{{ url('empleado/') }}">Regresar</a>

    <br>