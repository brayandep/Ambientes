<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//agregamos spatie
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BD;

class RolController extends Controller
{
    public function verForm()
    {
        $permissions = Permission::all(); // Obtiene todos los permisos
        return view('RegistroRol.Registrar_roles_nuevos', compact('permissions'));
    }
    function __construct(){
        // $this->middleware('permission: ver-rol | crear-rol | editar-rol' , ['only' => ['index']]);
        // $this->middleware('permission: crear-rol', ['only'=> ['create','store']]); 
        // $this->middleware('permission: editar-rol', ['only'=> ['edit','update']]); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role :: orderBy('id', 'desc')->paginate();
        return view('RegistroRol.Visualizar_roles' , compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view ('roles.crear', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $fechaFormateada = Carbon::now()->format('Y-m-d'); // Ejemplo para el formato "año-mes-día"

        $request->validate([
            'name' => 'required|max:50|regex:/^[a-zA-Z\s]+$/',
            'descripcionRol' => 'max:255', // Modificado para permitir mayor longitud y caracteres
            'tipoVigencia' => 'required',
            // 'fechaInicioRol' => 'required_if:tipoVigencia,temporal|date', // Sólo requerido si tipoVigencia es temporal
            // 'fechaFinRol' => 'required_if:tipoVigencia,temporal|date', // Sólo requerido si tipoVigencia es temporal
            'permissions' => 'required|array', // Asegura que se envíe al menos un permiso
            'permissions.*' => 'exists:permissions,id' // Cada permiso debe existir
        ]);

        $rol = Role::create([
            'name' => $request->input('name'),
            'guard_name' => 'web', // asumiendo que estás usando el guard por defecto
            'Estado' => $request->input('Estado'),
            'descripcionRol' => $request->input('descripcionRol'),
            'tipoVigencia' => $request->input('tipoVigencia'),
            'fechaInicioRol' =>$fechaFormateada,
            'fechaFinRol' => $request->input('fechaFinRol')
        ]);

        $rol->syncPermissions($request->input('permissions'));

        return redirect()->route('Rol.index'); // Asegúrate de que esta ruta está bien definida
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function habilitar(Request $request, $id)
    {
        $rol = Role::find($id);
        //print_r($request -> Estado);
    
        // Cambiar el estado de 1 a 0 y viceversa
        $rol->Estado = $rol->Estado == 1 ? 0 : 1;
    
        $rol->save();
        return redirect()->route('Rol.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        // $permission = Permission::get();
        // $rolePermissions = BD::table('role_has_permissions')->where('role_has_permissions.role_id', $role)
        //         ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        //         ->all();
        // return view('roles.editar', compact('role', 'permission','rolePermissions'));
    }       

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request -> validate([
            'name' => 'required|max:50|regex:/^[a-zA-Z\s]+$/',
            // 'descripcionRol' => 'required|max:50|regex:/^[a-zA-Z\s]+$/',
            // 'tipoVigencia' => 'required',
            // 'fechaInicioRol' => 'required',
            'permission'=> 'required'
        ]);
        $role ->name= $request->name;
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
