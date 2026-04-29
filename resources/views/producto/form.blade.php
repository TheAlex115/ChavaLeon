<div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre ?? '') }}" class="form-control">
</div>

<div class="form-group">
    <label for="categoria">Categoría</label>
    <input type="text" name="categoria" value="{{ old('categoria', $producto->categoria ?? '') }}" class="form-control">
</div>

<div class="form-group">
    <label for="precio">Precio</label>
    <input type="number" step="0.01" name="precio" value="{{ old('precio', $producto->precio ?? '') }}" class="form-control">
</div>

<div class="form-group">
    <label for="cantidad">Cantidad</label>
    <input type="number" name="cantidad" value="{{ old('cantidad', $producto->cantidad ?? '') }}" class="form-control">
</div>

<div class="form-group">
    <label for="descripcion">Descripción</label>
    <textarea name="descripcion" class="form-control">{{ old('descripcion', $producto->descripcion ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="foto">Foto</label>
    @if(isset($producto->foto))
        <img src="{{ asset('storage/'.$producto->foto) }}" width="100">
    @endif
    <input type="file" name="foto" class="form-control">
</div>
