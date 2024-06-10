<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\KabupatenKotaModel;
use App\DataTables\KabupatenKotasDataTable;
use App\Models\KategoriPsuModel;
use DB;

class KabupatenKotaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware(['permission:role-list|role-create|role-edit|role-delete'], ['only' => ['index', 'store']]);
        //$this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        //$this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        //$this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
        
        $this->middleware('auth');
    }

    public function index(KabupatenKotasDataTable $dataTable)
    {
        return $dataTable->render('vendor.adminlte.kabupatenkotas.index');
    }

    public function indexxx(Request $request)
    {
        $kabupatenkotas = KabupatenKotaModel::orderBy('id', 'DESC')->paginate(20);
        return view('vendor.adminlte.kabupatenkotas.index', compact('kabupatenkotas'));
    }

    public function getData(Request $request)
    {
        $kabupatenkotas = KabupatenKotaModel::orderBy('id', 'DESC')->paginate(20);
        return view('vendor.adminlte.kabupatenkotas.index', compact('kabupatenkotas'));
    }

    public function create(Request $request)
    {
        $kategoriPsus = KategoriPsuModel::get();
        if($request->ajax()){
            return view('vendor.adminlte.kabupatenkotas.form-create', compact('kategoriPsus'));
        }else{
            return view('vendor.adminlte.kabupatenkotas.create', compact('kategoriPsus'));
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'alt_name' => 'required',
            'latitude' => '',
            'longitude' => '',
        ]);

        $kabupatenkota = KabupatenKotaModel::create([
            'province_id' => 63,
            'name' => $request->input('name'),
            'alt_name' => $request->input('alt_name'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        return redirect()->route('admin.kabupaten-kota.index')
            ->with('success', 'Kabupaten / Kota berhasil disimpan');
    }

    public function show($id,Request $request)
    {
        $kabupatenkota = KabupatenKotaModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if($request->ajax()){
            return view('vendor.adminlte.kabupatenkotas.form-show', compact('kabupatenkota', 'kategoriPsus'));
        }else{
            return view('vendor.adminlte.kabupatenkotas.show', compact('kabupatenkota', 'kategoriPsus'));
        }
    }

    public function edit($id,Request $request)
    {
        $kabupatenkota = KabupatenKotaModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if($request->ajax()){
            return view('vendor.adminlte.kabupatenkotas.form-edit', compact('kabupatenkota', 'kategoriPsus'));
        }else{
            return view('vendor.adminlte.kabupatenkotas.edit', compact('kabupatenkota', 'kategoriPsus'));
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'alt_name' => 'required',
            'latitude' => '',
            'longitude' => '',
        ]);

        $kabupatenkota = KabupatenKotaModel::find($id);
        $kabupatenkota->province_id = 63;
        $kabupatenkota->name = $request->input('name');
        $kabupatenkota->alt_name = $request->input('alt_name');
        $kabupatenkota->latitude = $request->input('latitude');
        $kabupatenkota->longitude = $request->input('longitude');
        $kabupatenkota->save();


        return redirect()->route('admin.kabupaten-kota.index')
            ->with('success', 'Kabupaten / Kota berhasil diubah');
    }

    public function destroy($id)
    {
        DB::table("regencies")->where('id', $id)->delete();
        return redirect()->route('admin.kabupaten-kota.index')
            ->with('success', 'Kabupaten / Kota telah dihapus');
    }
}
