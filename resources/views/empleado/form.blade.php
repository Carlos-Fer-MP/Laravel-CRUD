<!---->
<br>
<h1>{{$modo}} emplado</h1>    

<!---->
@if(count($errors)>0)

  <!---->
  <div class="alert alert-danger " role="alert">
    <ul>
        @foreach($errors->all() as $error)
  
         <li>{{$error}}</li>

        @endforeach
    </ul>
  </div>

@endif

<!---->
<div class="form-group">
<label for="Nombre"> Nombre </label>
<input type="text" name="Nombre" class="form-control" value="{{isset($empleado->Nombre)?$empleado->Nombre:old('Nombre')}}" id="Nombre">
</div>


<div class="form-group">
<label for="Apellido1"> Primer Apellido </label>
<input type="text" name="Apellido1" class="form-control" value="{{isset($empleado->Apellido1)?$empleado->Apellido1:old('Apellido1')}}" id="Apellido1">
</div>


<div class="form-group">
<label for="Apellido2"> Segundo Apellido </label>
<input type="text" name="Apellido2" class="form-control" value="{{isset($empleado->Apellido2)?$empleado->Apellido2:old('Apellido2')}}" id="Apellido2">
</div>


<div class="form-group">
<label for="Correo"> Correo </label>
<input type="text" name="Correo" class="form-control" value="{{isset($empleado->Correo)?$empleado->Correo:old('Correo')}}" id="Correo">
<div class="form-group">

<!---->
<label for="Foto"> Foto </label>
@if(isset($empleado->Foto))
<img src="{{asset('storage'.'/'.$empleado->Foto)}}" alt="">
@endif
<input type="file" name="Foto" class="form-control" value="" id="Foto">
</div>

<div class="form-group">
<label for="Enviar"> Enviar </label>
<!---->
<input class="btn btn-success" type="submit" value="{{$modo}} datos">

<a href="{{url('empleado')}}" class="btn btn-primary">Regresar</a>
</div>