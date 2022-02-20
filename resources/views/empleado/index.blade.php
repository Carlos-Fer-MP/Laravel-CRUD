<!---->
@extends('layouts.app')
@section('content')
<div class="container">

<!---->
  @if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible" role="alert">
    
        {{Session::get('mensaje')}}
    
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">

            <span aria-hidden="true">&times;</span>

        </button>
    </div>
  @endif

<a href="{{url('empleado\create')}}" class="btn btn-success">Registrar nuevo empleado</a>
<br>
<br>
<table class="table table-light"> 
    <thead class="thead-light">
        <tr>

            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Correo</th>
            <th>Acciones</th>

        </tr>
    </thead>

    <tbody>
        //
        @foreach($empleados as $empleado)
        <tr>
            //
            <td>{{$empleado->id}}</td>
            <td>
                <img src="{{asset('storage'.'/'.$empleado->Foto)}}" class="img-thumbnail img-fluid" alt="">

                {{$empleado->Foto}}

            </td>
            <td>{{$empleado->Nombre}}</td>
            <td>{{$empleado->Apellido1}}</td>
            <td>{{$empleado->Apellido2}}</td>
            <td>{{$empleado->Correo}}</td>
            <td>
                
                <a href="{{url('/empleado/'.$empleado->id.'/edit')}}" class="btn btn-warning">Editar</a> |

                //
                <form action="{{url('/empleado'.$empleado->id)}}" class="d-inline" method="post">

                 @csrf
                 {{method_field('DELETE')}}
                    //
                 <input type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar" class="btn btn-danger">

                </form>    

            </td>
        </tr>
        @endforeach
    </tbody>

</table>
{!! $empleados->links() !!}
</div>
@endsection