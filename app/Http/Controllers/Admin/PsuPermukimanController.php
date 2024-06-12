<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\PsuModel;
use App\Models\PsupermukimanModel;
use App\Models\PsuAttributeModel;
use App\Models\PsuAttributePermukimanModel;
use App\DataTables\psupermukimansDataTable;
use App\Models\KategoriPsuModel;
use App\Models\JenisPsuModel;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Enums\Srid;
use DB;
use Storage;

class PsuPermukimanController extends Controller
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
        return $dataTable->render('vendor.adminlte.psupermukimans.index');
    }

    public function indexxx(Request $request)
    {
        $psupermukimans = PsuPermukimanModel::orderBy('id', 'DESC')->paginate(20);
        return view('vendor.adminlte.psupermukimans.index', compact('psupermukimans'));
    }

    public function getData(Request $request)
    {
        $psupermukimans = PsuPermukimanModel::orderBy('id', 'DESC')->paginate(20);
        return view('vendor.adminlte.psupermukimans.index', compact('psupermukimans'));
    }

    public function create(Request $request)
    {
        $kategoriPsus = KategoriPsuModel::get();
        $jenisPsus = JenisPsuModel::get();
        if($request->ajax()){
            return view('vendor.adminlte.psupermukimans.form-create', compact('kategoriPsus'));
        }else{
            return view('vendor.adminlte.psupermukimans.create', compact('kategoriPsus'));
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'jenis_permukiman' => '',
            'id_permukiman' => '',
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

        $psupermukiman = PsuPermukimanModel::create([
            'jenis_permukiman' => $request->input('jenis_permukiman'),
            'id_permukiman' => $request->input('id_permukiman'),
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

        return redirect()->route('admin.psupermukiman.index')
            ->with('success', 'Jenis PSU berhasil disimpan');
    }

    public function show($id,Request $request)
    {
        $psupermukiman = PsuPermukimanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();
        $jenisPsus = JenisPsuModel::get();

        if($request->ajax()){
            return view('vendor.adminlte.psupermukimans.form-show', compact('psupermukiman', 'kategoriPsus', 'jenisPsus'));
        }else{
            return view('vendor.adminlte.psupermukimans.show', compact('psupermukiman', 'kategoriPsus', 'jenisPsus'));
        }
    }

    public function edit($id,Request $request)
    {
        $psupermukiman = PsuPermukimanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();
        $jenisPsus = JenisPsuModel::get();

        if($request->ajax()){
            return view('vendor.adminlte.psupermukimans.form-edit', compact('psupermukiman', 'kategoriPsus', 'jenisPsus'));
        }else{
            return view('vendor.adminlte.psupermukimans.edit', compact('psupermukiman', 'kategoriPsus', 'jenisPsus'));
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'jenis_permukiman' => '',
            'id_permukiman' => '',
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

        $psupermukiman = PsuPermukimanModel::find($id);
        $psupermukiman->jenis_permukiman = $request->input('jenis_permukiman');
        $psupermukiman->id_permukiman = $request->input('id_permukiman');
        $psupermukiman->id_kategori = $request->input('id_kategori');
        //$psupermukiman->id_kategori = $kategori;
        $psupermukiman->id_jenis_psu = $request->input('id_jenis_psu');
        $psupermukiman->id_psu = $request->input('id_psu');
        $psupermukiman->nama_psu = $request->input('nama_psu');
        $psupermukiman->deskripsi = $request->input('deskripsi');
        $psupermukiman->bast_status = $request->input('bast_status') ?? 'belum';
        $psupermukiman->bast_file = $request->input('bast_file');
        $psupermukiman->bast_tanggal = $request->input('bast_tanggal');
        $psupermukiman->kondisi = $request->input('kondisi');
        $psupermukiman->latitude = $request->input('latitude');
        $psupermukiman->longitude = $request->input('longitude');
        $psupermukiman->latlong = $request->input('latlong');
        $psupermukiman->save();

        return redirect()->route('admin.psupermukiman.index')
            ->with('success', 'Jenis PSU berhasil diubah');
    }

    public function destroy($id)
    {
        DB::table("districts")->where('id', $id)->delete();
        return redirect()->route('admin.psupermukiman.index')
            ->with('success', 'Jenis PSU telah dihapus');
    }

    public function storeFromPermukiman(Request $request)
    {
        $this->validate($request, [
            'jenis_permukiman' => '',
            'id_permukiman' => '',
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
            $path = $file->store('uploads/psupermukiman/photo', 'public');
            //$file_bast = $file->getClientOriginalName();
            //$file_bast = basename($path);
            $photo = $path;
        }

        $dt = [
            'jenis_permukiman' => $request->input('jenis_permukiman'),
            'id_permukiman' => $request->input('id_permukiman'),
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

        $psupermukiman = PsuPermukimanModel::create($dt);
        return $psupermukiman->toJson();
    }

    public function getPsuAttributeForm(PsuPermukimanModel $PsuPermukiman,PsuModel $PSU){
        if(empty($PsuPermukiman)){
            return '';
        }

        $attributes = PsuAttributeModel::where(function($query) use ($PsuPermukiman,$PSU){
            $query->where('id_psu','=',$PSU->id);
        })->get();
        
        $output = '';
        foreach($attributes as $i => $a)
        {
            $value = \App\Models\PsuAttributePermukimanModel::where(function($query) use ($PsuPermukiman,$a) {
                $query->where('id_permukiman','=',$PsuPermukiman->id_permukiman);
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

    public function getPsuItem(PsuPermukimanModel $PsuPermukiman){
        if(empty($PsuPermukiman)){
            return '';
        }

        $list_psu_options = '';
        $jenis_psu = $PsuPermukiman->getJenisPsu;
        $psu = $PsuPermukiman;

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
    public function updateFromPermukiman(Request $request, $id)
    {
        $this->validate($request, [
            'jenis_permukiman' => '',
            'id_permukiman' => '',
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
            //$path = $file->store('uploads/psupermukiman/photo', 'public');
            
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $name = $file->getClientOriginalName();
            $uploadPath = 'public/uploads/psupermukiman/photo/'.$id ; //.'/'.$name.'.'.$extension;
            //$path = $file->storeAs($uploadPath, 'public');
            //$path = $file->storeAs($uploadPath, $file->getClientOriginalName());
            $path = $file->storeAs($uploadPath, $name.'-'.date("Ymdhis").'.'.$extension);

            //$file_bast = $file->getClientOriginalName();
            //$file_bast = basename($path);
            $photo = $path;
        }

        $psupermukiman = PsuPermukimanModel::find($id);
        $psupermukiman->jenis_permukiman = $request->input('jenis_permukiman');
        $psupermukiman->id_permukiman = $request->input('id_permukiman');
        $psupermukiman->id_jenis_psu = $request->input('id_jenis_psu');
        $psupermukiman->id_psu = $request->input('id_psu');
        $psupermukiman->nama_psu = $request->input('nama_psu');
        $psupermukiman->deskripsi = $request->input('deskripsi');
        $psupermukiman->bast_status = $request->input('bast_status') ?? 'belum';
        $psupermukiman->bast_file = $request->input('bast_file');
        $psupermukiman->bast_tanggal = $request->input('bast_tanggal');
        $psupermukiman->kondisi = $request->input('kondisi');
        $psupermukiman->latitude = $request->input('latitude');
        $psupermukiman->longitude = $request->input('longitude');
        $psupermukiman->latlong = (!empty($request->input('latitude').$request->input('longitude')))?new Point($request->input('latitude'),$request->input('longitude'), Srid::WGS84->value):null;
        $jenisPsu = JenisPsuModel::find($psupermukiman->id_jenis_psu)?->first();
        $psupermukiman->id_kategori = $jenisPsu?->kategori ?? 0;

        if(!empty($photo))
        {
            $psupermukiman->photo = $photo;
        }

        $psupermukiman->save();

        return $psupermukiman->toJson();

    }
    
    public function updatePsuItem(Request $request, $id)
    {
        $this->validate($request, [
            'jenis_permukiman' => '',
            'id_permukiman' => '',
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
            $path = $file->store('uploads/psupermukiman/photo', 'public');
            //$file_bast = $file->getClientOriginalName();
            //$file_bast = basename($path);
            $photo = $path;
        } */

        $psupermukiman = PsuPermukimanModel::find($id);
        $id_permukiman = $request->input('id_permukiman');
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

        if(!empty($id_permukiman)){
            $psupermukiman->id_permukiman = $id_permukiman;
        }
        if(!empty($id_jenis_psu)){
            $psupermukiman->id_jenis_psu = $id_jenis_psu;
        }
        if(!empty($id_psu)){
            $psupermukiman->id_psu = $id_psu;
        }
        if(!empty($nama_psu)){
            $psupermukiman->nama_psu = $nama_psu;
        }
        if(!empty($deskripsi)){
            $psupermukiman->deskripsi = $deskripsi;
        }
        if(!empty($bast_status)){
            $psupermukiman->bast_status = $bast_status;
        }
        if(!empty($bast_file)){
            $psupermukiman->bast_file = $bast_file;
        }
        if(!empty($bast_tanggal)){
            $psupermukiman->bast_tanggal = $bast_tanggal;
        }
        if(!empty($kondisi)){
            $psupermukiman->kondisi = $kondisi;
        }
        if(!empty($latitude)){
            $psupermukiman->latitude = $latitude;
        }
        if(!empty($longitude)){
            $psupermukiman->longitude = $longitude;
        }
        if(!empty($id_kategori)){
            $psupermukiman->id_kategori = $id_kategori;
        }
        
        //$latlong = (!empty($request->input('latitude').$request->input('longitude')))?new Point($request->input('latitude'),$request->input('longitude'), Srid::WGS84->value):null;
        //$kategori = JenisPsuModel::find($psupermukiman->id_jenis_psu)?->first();
        //$psupermukiman->id_kategori = $kategori?->kategori_id ?? 0;

        //if(!empty($photo))
        //{
        //    $psupermukiman->photo = $photo;
        //}

        $psupermukiman->save();
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

            $attributes = PsuAttributePermukimanModel::updateOrCreate(
                [
                    'id_permukiman' => $psupermukiman->id_permukiman,
                    'id_jenis_psu' => $psupermukiman->id_jenis_psu,
                    'id_psu' => $psupermukiman->id_psu,
                    'id_psu_permukiman' => $psupermukiman->id,
                    'id_psu_attribute' => $i,
                ],
                [
                    'value' => $attr
                ]
            );
        }
        return $psupermukiman->toJson();

    }
}
