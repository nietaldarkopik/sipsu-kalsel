<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\KecamatanModel;
use App\DataTables\KecamatansDataTable;
use App\Models\KabupatenKotaModel;
use DB;

class KecamatanController extends Controller
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

    public function index(KecamatansDataTable $dataTable)
    {
        return $dataTable->render('vendor.adminlte.kecamatans.index');
    }

    public function indexxx(Request $request)
    {
        $kecamatans = KecamatanModel::orderBy('id', 'DESC')->paginate(20);
        return view('vendor.adminlte.kecamatans.index', compact('kecamatans'));
    }

    public function getData(Request $request)
    {
        $kecamatans = KecamatanModel::orderBy('id', 'DESC')->paginate(20);
        return view('vendor.adminlte.kecamatans.index', compact('kecamatans'));
    }

    public function create(Request $request)
    {
        $kabupatenKotas = KabupatenKotaModel::get();
        if($request->ajax()){
            return view('vendor.adminlte.kecamatans.form-create', compact('kabupatenKotas'));
        }else{
            return view('vendor.adminlte.kecamatans.create', compact('kabupatenKotas'));
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'regency_id' => 'required',
            'name' => 'required',
            'alt_name' => '',
            'latitude' => '',
            'longitude' => '',
        ]);

        $role = KecamatanModel::create([
            'regency_id' => $request->input('regency_id'),
            'name' => $request->input('name'),
            'alt_name' => $request->input('alt_name'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        return redirect()->route('admin.kecamatan.index')
            ->with('success', 'Kecamatan berhasil disimpan');
    }

    public function show($id,Request $request)
    {
        $kecamatan = KecamatanModel::find($id);
        $kabupatenKotas = KabupatenKotaModel::get();

        if($request->ajax()){
            return view('vendor.adminlte.kecamatans.form-show', compact('kecamatan', 'kabupatenKotas'));
        }else{
            return view('vendor.adminlte.kecamatans.show', compact('kecamatan', 'kabupatenKotas'));
        }
    }

    public function edit($id,Request $request)
    {
        $kecamatan = KecamatanModel::find($id);
        $kabupatenKotas = KabupatenKotaModel::get();

        if($request->ajax()){
            return view('vendor.adminlte.kecamatans.form-edit', compact('kecamatan', 'kabupatenKotas'));
        }else{
            return view('vendor.adminlte.kecamatans.edit', compact('kecamatan', 'kabupatenKotas'));
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'regency_id' => 'required',
            'name' => 'required',
            'alt_name' => '',
            'latitude' => '',
            'longitude' => '',
        ]);

        $role = KecamatanModel::find($id);
        $role->regency_id = $request->input('regency_id');
        $role->name = $request->input('name');
        $role->alt_name = $request->input('alt_name');
        $role->latitude = $request->input('latitude');
        $role->longitude = $request->input('longitude');
        $role->save();


        return redirect()->route('admin.kecamatan.index')
            ->with('success', 'Kecamatan berhasil diubah');
    }

    public function destroy($id)
    {
        DB::table("districts")->where('id', $id)->delete();
        return redirect()->route('admin.kecamatan.index')
            ->with('success', 'Kecamatan telah dihapus');
    }
}
