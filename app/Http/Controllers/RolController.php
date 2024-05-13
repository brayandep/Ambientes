<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//agregamos spatie
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class RolController extends Controller
{
    function __construct(){
        $this->middleware('permission: ver-rol | crear-rol | editar-rol' , ['only' => ['index']]);
        $this->middleware('permission: crear-rol', ['only'=> ['create','store']]); 
        $this->middleware('permission: editar-rol', ['only'=> ['edit','update']]); 

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role :: all();
        return view('roles.index' , compact('roles'));
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
        $request -> validate([
            'name' => 'required|max:50|regex:/^[a-zA-Z\s]+$/',
            // 'descripcionRol' => 'required|max:50|regex:/^[a-zA-Z\s]+$/',
            // 'tipoVigencia' => 'required',
            // 'fechaInicioRol' => 'required',
            'permission'=> 'required'
        ]);
        // $rol = new Role();
        // $rol -> Estado = $request -> Estado;
        // $rol -> nombreRol = $request -> nommbreRol;
        // $rol -> descripcionRol = $request -> descripcionRol;
        // $rol -> tipoVigencia = $request -> tipoVigencia;
        // $rol -> fechaInicioRol = $request ->fechaInicioRol;
        // $rol -> fechaFinRol = $request -> fechaFinRol;
        // $rol -> save();
        $role = Role::create(['name'=> $request->input('name')]);
        $role->syncPermissions($request->imput('permission'));

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permission = Permission::get();
        $rolePermissions = BD::table('role_has_permissions')->where('role_has_permissions.role_id', $role)
                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                ->all();
        return view('roles.editar', compact('role', 'permission','rolePermissions'));
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
