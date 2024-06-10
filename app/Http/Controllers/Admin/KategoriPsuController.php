<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\KategoriPsuModel;
use App\DataTables\KategoriPsusDataTable;
use App\Models\KabupatenKotaModel;
use DB;

class KategoriPsuController extends Controller
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

    public function index(KategoriPsusDataTable $dataTable)
    {
        return $dataTable->render('vendor.adminlte.kategoripsus.index');
    }

    public function indexxx(Request $request)
    {
        $kategoripsus = KategoriPsuModel::orderBy('id', 'DESC')->paginate(20);
        return view('vendor.adminlte.kategoripsus.index', compact('kategoripsus'));
    }

    public function getData(Request $request)
    {
        $kategoripsus = KategoriPsuModel::orderBy('id', 'DESC')->paginate(20);
        return view('vendor.adminlte.kategoripsus.index', compact('kategoripsus'));
    }

    public function create(Request $request)
    {
        if($request->ajax()){
            return view('vendor.adminlte.kategoripsus.form-create', compact('kabupatenKotas'));
        }else{
            return view('vendor.adminlte.kategoripsus.create', compact('kabupatenKotas'));
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'deskripsi' => '',
        ]);

        $kategoripsu = KategoriPsuModel::create([
            'title' => $request->input('title'),
            'deskripsi' => $request->input('deskripsi'),
        ]);

        return redirect()->route('admin.kategoripsu.index')
            ->with('success', 'Kategori PSU berhasil disimpan');
    }

    public function show($id,Request $request)
    {
        $kategoripsu = KategoriPsuModel::find($id);

        if($request->ajax()){
            return view('vendor.adminlte.kategoripsus.form-show', compact('kategoripsu'));
        }else{
            return view('vendor.adminlte.kategoripsus.show', compact('kategoripsu'));
        }
    }

    public function edit($id,Request $request)
    {
        $kategoripsu = KategoriPsuModel::find($id);

        if($request->ajax()){
            return view('vendor.adminlte.kategoripsus.form-edit', compact('kategoripsu'));
        }else{
            return view('vendor.adminlte.kategoripsus.edit', compact('kategoripsu'));
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'deskripsi' => '',
        ]);

        $kategoripsu = KategoriPsuModel::find($id);
        $kategoripsu->title = $request->input('title');
        $kategoripsu->deskripsi = $request->input('deskripsi');
        $kategoripsu->save();


        return redirect()->route('admin.kategoripsu.index')
            ->with('success', 'Kategori PSU berhasil diubah');
    }

    public function destroy($id)
    {
        DB::table("kategori_psu")->where('id', $id)->delete();
        return redirect()->route('admin.kategoripsu.index')
            ->with('success', 'Kategori PSU telah dihapus');
    }
}
