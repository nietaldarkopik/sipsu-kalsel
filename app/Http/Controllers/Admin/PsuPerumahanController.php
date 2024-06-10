<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\PsuModel;
use App\Models\PsuperumahanModel;
use App\Models\PsuAttributeModel;
use App\Models\PsuAttributePerumahanModel;
use App\DataTables\psuperumahansDataTable;
use App\Models\KategoriPsuModel;
use App\Models\JenisPsuModel;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Enums\Srid;
use DB;
use Storage;

class PsuPerumahanController extends Controller
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

    public function index($dataTable)
    {
        return $dataTable->render('vendor.adminlte.psuperumahans.index');
    }

    public function indexxx(Request $request)
    {
        $psuperumahans = PsuPerumahanModel::orderBy('id', 'DESC')->paginate(20);
        return view('vendor.adminlte.psuperumahans.index', compact('psuperumahans'));
    }

    public function getData(Request $request)
    {
        $psuperumahans = PsuPerumahanModel::orderBy('id', 'DESC')->paginate(20);
        return view('vendor.adminlte.psuperumahans.index', compact('psuperumahans'));
    }

    public function create(Request $request)
    {
        $kategoriPsus = KategoriPsuModel::get();
        $jenisPsus = JenisPsuModel::get();
        if($request->ajax()){
            return view('vendor.adminlte.psuperumahans.form-create', compact('kategoriPsus'));
        }else{
            return view('vendor.adminlte.psuperumahans.create', compact('kategoriPsus'));
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'jenis_perumahan' => '',
            'id_perumahan' => '',
            'id_kategori' => '',
            'id_jenis_psu' => '',
            'id_psu' => '',
            'nama_psu' => '',
            'photo' => 'file|mimes:jpg,jpeg,png',
            'deskripsi' => '',
            'bast_status' => '',
            'bast_file' => '',
            'bast_tanggal' => '',
            'kondisi' => '',
            'latitude' => '',
            'longitude' => '',
            'latlong' => '',
        ]);

        $psuperumahan = PsuPerumahanModel::create([
            'jenis_perumahan' => $request->input('jenis_perumahan'),
            'id_perumahan' => $request->input('id_perumahan'),
            'id_kategori' => $request->input('id_kategori'),
            'id_jenis_psu' => $request->input('id_jenis_psu'),
            'id_psu' => $request->input('id_psu'),
            'nama_psu' => $request->input('nama_psu'),
            'deskripsi' => $request->input('deskripsi'),
            'bast_status' => $request->input('bast_status') ?? 'belum',
            'bast_file' => $request->input('bast_file'),
            'bast_tanggal' => $request->input('bast_tanggal'),
            'kondisi' => $request->input('kondisi'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'latlong' => $request->input('latlong'),
        ]);

        return redirect()->route('admin.psuperumahan.index')
            ->with('success', 'Jenis PSU berhasil disimpan');
    }

    public function show($id,Request $request)
    {
        $psuperumahan = PsuPerumahanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();
        $jenisPsus = JenisPsuModel::get();

        if($request->ajax()){
            return view('vendor.adminlte.psuperumahans.form-show', compact('psuperumahan', 'kategoriPsus', 'jenisPsus'));
        }else{
            return view('vendor.adminlte.psuperumahans.show', compact('psuperumahan', 'kategoriPsus', 'jenisPsus'));
        }
    }

    public function edit($id,Request $request)
    {
        $psuperumahan = PsuPerumahanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();
        $jenisPsus = JenisPsuModel::get();

        if($request->ajax()){
            return view('vendor.adminlte.psuperumahans.form-edit', compact('psuperumahan', 'kategoriPsus', 'jenisPsus'));
        }else{
            return view('vendor.adminlte.psuperumahans.edit', compact('psuperumahan', 'kategoriPsus', 'jenisPsus'));
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'jenis_perumahan' => '',
            'id_perumahan' => '',
            'id_kategori' => '',
            'id_jenis_psu' => '',
            'id_psu' => '',
            'nama_psu' => '',
            'photo' => 'file|mimes:jpg,jpeg,png',
            'deskripsi' => '',
            'bast_status' => '',
            'bast_file' => '',
            'bast_tanggal' => '',
            'kondisi' => '',
            'latitude' => '',
            'longitude' => '',
            'latlong' => '',
        ]);

        $psuperumahan = PsuPerumahanModel::find($id);
        $psuperumahan->jenis_perumahan = $request->input('jenis_perumahan');
        $psuperumahan->id_perumahan = $request->input('id_perumahan');
        $psuperumahan->id_kategori = $request->input('id_kategori');
        //$psuperumahan->id_kategori = $kategori;
        $psuperumahan->id_jenis_psu = $request->input('id_jenis_psu');
        $psuperumahan->id_psu = $request->input('id_psu');
        $psuperumahan->nama_psu = $request->input('nama_psu');
        $psuperumahan->deskripsi = $request->input('deskripsi');
        $psuperumahan->bast_status = $request->input('bast_status') ?? 'belum';
        $psuperumahan->bast_file = $request->input('bast_file');
        $psuperumahan->bast_tanggal = $request->input('bast_tanggal');
        $psuperumahan->kondisi = $request->input('kondisi');
        $psuperumahan->latitude = $request->input('latitude');
        $psuperumahan->longitude = $request->input('longitude');
        $psuperumahan->latlong = $request->input('latlong');
        $psuperumahan->save();

        return redirect()->route('admin.psuperumahan.index')
            ->with('success', 'Jenis PSU berhasil diubah');
    }

    public function destroy($id)
    {
        DB::table("districts")->where('id', $id)->delete();
        return redirect()->route('admin.psuperumahan.index')
            ->with('success', 'Jenis PSU telah dihapus');
    }

    public function storeFromPerumahan(Request $request)
    {
        $this->validate($request, [
            'jenis_perumahan' => '',
            'id_perumahan' => '',
            'id_kategori' => '',
            'id_jenis_psu' => '',
            'id_psu' => '',
            'nama_psu' => '',
            'photo' => 'file|mimes:jpg,jpeg,png',
            'deskripsi' => '',
            'bast_status' => '',
            'bast_file' => '',
            'bast_tanggal' => '',
            'kondisi' => '',
            'latitude' => '',
            'longitude' => '',
            'latlong' => '',
        ]);

        
        $photo = '';
        
        if ($request->file('file')) {
            $file = $request->file('file');
            $path = $file->store('uploads/psuperumahan/photo', 'public');
            //$file_bast = $file->getClientOriginalName();
            //$file_bast = basename($path);
            $photo = $path;
        }

        $dt = [
            'jenis_perumahan' => $request->input('jenis_perumahan'),
            'id_perumahan' => $request->input('id_perumahan'),
            'id_jenis_psu' => $request->input('id_jenis_psu'),
            'id_psu' => $request->input('id_psu'),
            'nama_psu' => $request->input('nama_psu'),
            'deskripsi' => $request->input('deskripsi'),
            'bast_status' => $request->input('bast_status') ?? 'belum',
            'bast_file' => $request->input('bast_file'),
            'bast_tanggal' => $request->input('bast_tanggal'),
            'kondisi' => $request->input('kondisi'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'latlong' => (!empty($request->input('latitude').$request->input('longitude')))?new Point($request->input('latitude'),$request->input('longitude'), Srid::WGS84->value):null,
        ];

        if(!empty($photo))
        {
            $dt['photo'] = $photo;
        }

        $kategori = JenisPsuModel::find($dt['id_jenis_psu'])?->first();
        $dt['id_kategori'] = $kategori?->kategori ?? 0;

        $psuperumahan = PsuPerumahanModel::create($dt);
        return $psuperumahan->toJson();
    }

    public function getPsuAttributeForm(PsuPerumahanModel $PsuPerumahan,PsuModel $PSU){
        if(empty($PsuPerumahan)){
            return '';
        }

        $attributes = PsuAttributeModel::where(function($query) use ($PsuPerumahan,$PSU){
            $query->where('id_psu','=',$PSU->id);
        })->get();
        
        $output = '';
        foreach($attributes as $i => $a)
        {
            $value = \App\Models\PsuAttributePerumahanModel::where(function($query) use ($PsuPerumahan,$a) {
                $query->where('id_perumahan','=',$PsuPerumahan->id_perumahan);
                $query->where('id_jenis_psu','=',$a->id_jenis_psu);
                $query->where('id_psu','=',$a->id_psu);
            })->get()->first();
            $value = $value?->value ?? '';

            $output .= '
                        <div class="col-md-6 mb-1">
                            <div class="form-group mb-0">
                                <label class="mb-0" for="">'.$a->attribute.'</label>
                                <input type="text" name="attribute['.$a->id.']" class="form-control form-control-sm mb-0" placeholder="" value="'.$value.'">
                                <small class="text-desc">'.$a->keterangan.'</small>
                            </div>
                        </div>
                    ';    
        }

        return $output;
    }

    public function getPsuItem(PsuPerumahanModel $PsuPerumahan){
        if(empty($PsuPerumahan)){
            return '';
        }

        $list_psu_options = '';
        $jenis_psu = $PsuPerumahan->getJenisPsu;
        $psu = $PsuPerumahan;

        foreach(PsuModel::where('jenis',$jenis_psu->id)->get() as $ijp => $p)
        {
            $list_psu_options .= '<option value="'.$p->id.'" '.(($psu->id_kategori ?? '') == $p->id ? 'selected:"selected"' : '').'>'.$p->judul.'</option>';
        }

        $output = '
        <div class="row my-2">
            <div class="col-md-12">
                <div class="card mb-3 card-warning card-psu-item">
                    <div class="card-header">
                        <div class="card-title">
                            ' . ($jenis_psu->title ?? '') . '
                        </div>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row g-0">
                        <div class="col-sm-4 col-md-4">
                            <img src="' . asset(Storage::url($psu->photo)) . '"
                                class="img-fluid card-img-top object-fit-cover"
                                style="width: 100%; height: 100%; object-fit: cover;"
                                alt="' . $psu->nama_psu . '" title="' . $psu->nama_psu . '" />
                        </div>
                        <div class="col-sm-8 col-md-8">
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group mb-0">
                                            <label class="mb-0" for="">Nama PSU</label>
                                            <input type="text" name="nama_psu" class="form-control form-control-sm" placeholder="" value="' . $psu->nama_psu . '">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <label class="mb-0" for="">PSU</label>
                                            <select name="id_psu" class="form-control form-control-sm form-select form-select-sm" data-id="'.$psu->id .'">
                                                <option value="">Pilih PSU ...</option>'.
                                                    $list_psu_options
                                                .'
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <label class="mb-0" for="">Kondisi</label>
                                            <select name="kondisi" class="form-control form-control-sm form-select form-select-sm">
                                                <option value="">Pilih Kondisi ...</option>
                                                <option value="Baik" '.($psu->kondisi == 'Baik' ? 'selected="selected"' : '').'>Baik</option>
                                                <option value="Rusak Sedang" '.($psu->kondisi == 'Rusak Sedang' ? 'selected="selected"' : '').'>Rusak Sedang</option>
                                                <option value="Rusak Berat" '.($psu->kondisi == 'Rusak Berat' ? 'selected="selected"' : '').'>Rusak Berat</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row attribute-psu-container"></div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group mb-0">
                                            <label class="mb-0" for="">Keterangan Lainnya</label>
                                            <textarea name="deskripsi" class="form-control form-control-sm">'.$psu->deskripsi.'</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 btn-save-psu-container mt-2 d-none justify-content-end align-items-end">
                                        <button type="reset" class="btn btn-warning btn-cancel-psu ms-auto me-0 btn-sm">
                                            <i class="fas fa-sync" aria-hidden="true"></i> Batal
                                        </button>
                                        <button type="button" class="btn btn-primary btn-save-psu ms-auto me-0 btn-sm" href="#" role="button" data-id="'.$psu->id.'">
                                            <i class="fa fa-save" aria-hidden="true"></i> Simpan
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

        return $output;
    }
    public function updateFromPerumahan(Request $request, $id)
    {
        $this->validate($request, [
            'jenis_perumahan' => '',
            'id_perumahan' => '',
            'kategori' => '',
            'id_jenis_psu' => '',
            'nama_psu' => '',
            'photo' => 'file|mimes:jpg,jpeg,png',
            'deskripsi' => '',
            'bast_status' => '',
            'bast_file' => '',
            'bast_tanggal' => '',
            'kondisi' => '',
            'latitude' => '',
            'longitude' => '',
            'latlong' => '',
        ]);

        $photo = '';
        
        if ($request->file('file')) {
            $file = $request->file('file');
            //$path = $file->store('uploads/psuperumahan/photo', 'public');
            
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $name = $file->getClientOriginalName();
            $uploadPath = 'public/uploads/psuperumahan/photo/'.$id ; //.'/'.$name.'.'.$extension;
            //$path = $file->storeAs($uploadPath, 'public');
            //$path = $file->storeAs($uploadPath, $file->getClientOriginalName());
            $path = $file->storeAs($uploadPath, $name.'-'.date("Ymdhis").'.'.$extension);

            //$file_bast = $file->getClientOriginalName();
            //$file_bast = basename($path);
            $photo = $path;
        }

        $psuperumahan = PsuPerumahanModel::find($id);
        $psuperumahan->jenis_perumahan = $request->input('jenis_perumahan');
        $psuperumahan->id_perumahan = $request->input('id_perumahan');
        $psuperumahan->id_jenis_psu = $request->input('id_jenis_psu');
        $psuperumahan->id_psu = $request->input('id_psu');
        $psuperumahan->nama_psu = $request->input('nama_psu');
        $psuperumahan->deskripsi = $request->input('deskripsi');
        $psuperumahan->bast_status = $request->input('bast_status') ?? 'belum';
        $psuperumahan->bast_file = $request->input('bast_file');
        $psuperumahan->bast_tanggal = $request->input('bast_tanggal');
        $psuperumahan->kondisi = $request->input('kondisi');
        $psuperumahan->latitude = $request->input('latitude');
        $psuperumahan->longitude = $request->input('longitude');
        $psuperumahan->latlong = (!empty($request->input('latitude').$request->input('longitude')))?new Point($request->input('latitude'),$request->input('longitude'), Srid::WGS84->value):null;
        $jenisPsu = JenisPsuModel::find($psuperumahan->id_jenis_psu)?->first();
        $psuperumahan->id_kategori = $jenisPsu?->kategori ?? 0;

        if(!empty($photo))
        {
            $psuperumahan->photo = $photo;
        }

        $psuperumahan->save();

        return $psuperumahan->toJson();

    }
    
    public function updatePsuItem(Request $request, $id)
    {
        $this->validate($request, [
            'jenis_perumahan' => '',
            'id_perumahan' => '',
            'id_kategori' => '',
            'id_psu' => '',
            'id_jenis_psu' => '',
            'nama_psu' => '',
            'deskripsi' => '',
            'bast_status' => '',
            'bast_file' => '',
            'bast_tanggal' => '',
            'kondisi' => '',
            'latitude' => '',
            'longitude' => '',
            'latlong' => '',
        ]);

        $photo = '';
        
        /* if ($request->file('file')) {
            $file = $request->file('file');
            $path = $file->store('uploads/psuperumahan/photo', 'public');
            //$file_bast = $file->getClientOriginalName();
            //$file_bast = basename($path);
            $photo = $path;
        } */

        $psuperumahan = PsuPerumahanModel::find($id);
        $id_perumahan = $request->input('id_perumahan');
        $id_jenis_psu = $request->input('id_jenis_psu');
        $id_psu = $request->input('id_psu');
        $id_kategori = $request->input('id_kategori');
        $nama_psu = $request->input('nama_psu');
        $deskripsi = $request->input('deskripsi');
        $bast_status = $request->input('bast_status');
        $bast_file = $request->input('bast_file');
        $bast_tanggal = $request->input('bast_tanggal');
        $kondisi = $request->input('kondisi');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $attribute = $request->input('attribute');

        if(!empty($id_perumahan)){
            $psuperumahan->id_perumahan = $id_perumahan;
        }
        if(!empty($id_jenis_psu)){
            $psuperumahan->id_jenis_psu = $id_jenis_psu;
        }
        if(!empty($id_psu)){
            $psuperumahan->id_psu = $id_psu;
        }
        if(!empty($nama_psu)){
            $psuperumahan->nama_psu = $nama_psu;
        }
        if(!empty($deskripsi)){
            $psuperumahan->deskripsi = $deskripsi;
        }
        if(!empty($bast_status)){
            $psuperumahan->bast_status = $bast_status;
        }
        if(!empty($bast_file)){
            $psuperumahan->bast_file = $bast_file;
        }
        if(!empty($bast_tanggal)){
            $psuperumahan->bast_tanggal = $bast_tanggal;
        }
        if(!empty($kondisi)){
            $psuperumahan->kondisi = $kondisi;
        }
        if(!empty($latitude)){
            $psuperumahan->latitude = $latitude;
        }
        if(!empty($longitude)){
            $psuperumahan->longitude = $longitude;
        }
        if(!empty($id_kategori)){
            $psuperumahan->id_kategori = $id_kategori;
        }
        
        //$latlong = (!empty($request->input('latitude').$request->input('longitude')))?new Point($request->input('latitude'),$request->input('longitude'), Srid::WGS84->value):null;
        //$kategori = JenisPsuModel::find($psuperumahan->id_jenis_psu)?->first();
        //$psuperumahan->id_kategori = $kategori?->kategori_id ?? 0;

        //if(!empty($photo))
        //{
        //    $psuperumahan->photo = $photo;
        //}

        $psuperumahan->save();
        /* 
                    $o = [];
                    foreach($attribute as $i => $attr)
                    {
                        $o[] =PsuModel::find($i)?->getJenisPsu()->get();
                    }

                    dd($o);
        */

        foreach($attribute as $i => $attr)
        {
            $psu = PsuModel::find($i)->get()->first();
            $psuJenis = PsuModel::find($i)?->getJenisPsu()?->get()?->first();

            $attributes = PsuAttributePerumahanModel::updateOrCreate(
                [
                    'id_perumahan' => $psuperumahan->id_perumahan,
                    'id_jenis_psu' => $psuperumahan->id_jenis_psu,
                    'id_psu' => $psuperumahan->id_psu,
                    'id_psu_perumahan' => $psuperumahan->id,
                    'id_psu_attribute' => $i,
                ],
                [
                    'value' => $attr
                ]
            );
        }
        return $psuperumahan->toJson();

    }
}
