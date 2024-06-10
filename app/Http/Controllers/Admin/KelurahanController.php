<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\KelurahanModel;
use App\DataTables\KelurahansDataTable;
use App\Models\KabupatenKotaModel;
use DB;

class KelurahanController extends Controller
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

    public function index(KelurahansDataTable $dataTable)
    {
        return $dataTable->render('vendor.adminlte.kelurahans.index');
    }

    public function indexxx(Request $request)
    {
        $kelurahans = KelurahanModel::orderBy('id', 'DESC')->paginate(20);
        return view('vendor.adminlte.kelurahans.index', compact('kelurahans'));
    }

    public function getData(Request $request)
    {
        $kelurahans = KelurahanModel::orderBy('id', 'DESC')->paginate(20);
        return view('vendor.adminlte.kelurahans.index', compact('kelurahans'));
    }

    public function create(Request $request)
    {
        $kabupatenKotas = KabupatenKotaModel::get();
        if($request->ajax()){
            return view('vendor.adminlte.kelurahans.form-create', compact('kabupatenKotas'));
        }else{
            return view('vendor.adminlte.kelurahans.create', compact('kabupatenKotas'));
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'district_id' => 'required',
            'name' => 'required',
            'alt_name' => '',
            'latitude' => '',
            'longitude' => '',
        ]);

        $kelurahan = KelurahanModel::create([
            'district_id' => $request->input('district_id'),
            'name' => $request->input('name'),
            'alt_name' => $request->input('alt_name'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        return redirect()->route('admin.kelurahan.index')
            ->with('success', 'Kelurahan berhasil disimpan');
    }

    public function show($id,Request $request)
    {
        $kelurahan = KelurahanModel::find($id);
        $kabupatenKotas = KabupatenKotaModel::get();

        if($request->ajax()){
            return view('vendor.adminlte.kelurahans.form-show', compact('kelurahan', 'kabupatenKotas'));
        }else{
            return view('vendor.adminlte.kelurahans.show', compact('kelurahan', 'kabupatenKotas'));
        }
    }

    public function edit($id,Request $request)
    {
        $kelurahan = KelurahanModel::find($id);
        $kabupatenKotas = KabupatenKotaModel::get();

        if($request->ajax()){
            return view('vendor.adminlte.kelurahans.form-edit', compact('kelurahan', 'kabupatenKotas'));
        }else{
            return view('vendor.adminlte.kelurahans.edit', compact('kelurahan', 'kabupatenKotas'));
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'district_id' => 'required',
            'name' => 'required',
            'alt_name' => '',
            'latitude' => '',
            'longitude' => '',
        ]);

        $kelurahan = KelurahanModel::find($id);
        $kelurahan->district_id = $request->input('district_id');
        $kelurahan->name = $request->input('name');
        $kelurahan->alt_name = $request->input('alt_name');
        $kelurahan->latitude = $request->input('latitude');
        $kelurahan->longitude = $request->input('longitude');
        $kelurahan->save();


        return redirect()->route('admin.kelurahan.index')
            ->with('success', 'Kelurahan berhasil diubah');
    }

    public function destroy($id)
    {
        DB::table("villages")->where('id', $id)->delete();
        return redirect()->route('admin.kelurahan.index')
            ->with('success', 'Kelurahan telah dihapus');
    }
}
