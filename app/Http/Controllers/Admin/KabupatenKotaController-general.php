<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\KabupatenKotaModel as KabupatenKotaModel;

class KabupatenKotaController extends Controller
{
    function __construct()
    {
        //$this->middleware(['permission:role-list|role-create|role-edit|role-delete'], ['only' => ['index', 'store']]);
        //$this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        //$this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        //$this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
        
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $kabupatenkotas = KabupatenKotaModel::where('province_id',63)->orderBy('id', 'DESC')->paginate(20);
        return view('vendor.adminlte.kabupatenkotas.index', compact('kabupatenkotas'));
    }

    public function create()
    {
        $permission = Permission::get();
        return view('vendor.adminlte.kabupatenkotas.create', compact('permission'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:kabupatenkotas,name',
            'permission' => 'required',
        ]);

        $role = KabupatenKotaModel::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('admin.kabupatenkotas.index')
            ->with('success', 'KabupatenKota created successfully');
    }

    public function show($id)
    {
        $role = KabupatenKotaModel::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        return view('vendor.adminlte.kabupatenkotas.show', compact('role', 'rolePermissions'));
    }

    public function edit($id)
    {
        $role = KabupatenKotaModel::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('vendor.adminlte.kabupatenkotas.edit', compact('role', 'permission', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = KabupatenKotaModel::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('admin.kabupatenkotas.index')
            ->with('success', 'KabupatenKota updated successfully');
    }

    public function destroy($id)
    {
        DB::table("kabupatenkotas")->where('id', $id)->delete();
        return redirect()->route('admin.kabupatenkotas.index')
            ->with('success', 'KabupatenKota deleted successfully');
    }
}
