<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
//
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * Consultamos la información de los usuarios asignandole paguinación.
         * 
         * Y almacenamos los datos en la variabe $datos, para así verlo todo en la vista empeledo\index.
         * 
         **/

        $datos['empleados']=Empleado::paginate(1);
        return view('empleado.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $campos= [

            'Nombre'=>'required|string|max:100',
            'Apellido1'=>'required|string|max:100',
            'Apellido2'=>'required|string|max:100',
            'Correo'=>'required|email',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg'

        ];
        $mensaje=[

            'required'=>'El :attribute es requerido',
            'Foto.required'=>'La foto es requerida'

        ];

        //
        $this->validate($request,$campos,$mensaje);

        //Recoge todos los datos menos el token generado.
        $datosEmpleado = request()->except('_token');
        //Inserta los datos en la BD. 
        Empleado::insert($datosEmpleado);
        
        if($request->hasFile('Foto')){

          //Cambiamos el campo Foto con la inserción que hemos echo y esta la guardamos en public uploads.
          $datosEmpleado['Foto']= $request->file('Foto')->store('uploads','public');   

        }


        /*Devuelve una respuesta en formato Json con los datos.
         *return response()->json($datosEmpleado);
         */
        
         //
        return redirect('empleado')->with('Empleado agregado con exito');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $empleado=Empleado::findOrFail($id);
        return view('empleado.edit',compact('empleado'));



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $campos= [

            'Nombre'=>'required|string|max:100',
            'Apellido1'=>'required|string|max:100',
            'Apellido2'=>'required|string|max:100',
            'Correo'=>'required|email',
            
        
        ];
        $mensaje=[
        
            'required'=>'El :attribute es requerido'
            
        
        ];
       
        //
        if($request->hasFile('Foto')){

            $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=['Foto.required'=>'La foto es requerida'];

        }
        
        //
        $this->validate($request,$campos,$mensaje);

        //
        $datosEmpleado = $request->except(['_token','_method']);
        
        if($request->hasFile('Foto')){

            //
            $empleado=Empleado::findOrFail($id);
            Storage::delete('public/'.$empleado->Foto);

            //Cambiamos el campo Foto con la inserción que hemos echo y esta la guardamos en public uploads.
            $datosEmpleado['Foto']= $request->file('Foto')->store('uploads','public');   

        }

        Empleado::Where('id','=',$id)->update($datosEmpleado);
        
        //
        $empleado=Empleado::findOrFail($id);
        // return view('empleado.edit', compact('empleado'));
        return redirect('/empleado')->with('mensaje','Empleado editado con exito');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $empleado=Empleado::findOrFail($id);

        if(Storage::delete(['public/'.$empleado->Foto])){

            //
            Empleado::destroy($id);

        }        
        return redirect('/empleado')->with('mensaje','Empleado eliminado con exito');
    }
}
