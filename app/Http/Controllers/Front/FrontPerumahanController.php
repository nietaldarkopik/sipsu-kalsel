<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\PerumahanModel;
use App\DataTables\Front\PerumahanDataTable;
use App\Models\KategoriPsuModel;
use App\Models\PerumahanDokumenModel;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Enums\Srid;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use DB;
use Auth;
use Str;
use PDF;

class FrontPerumahanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index(PerumahanDataTable $dataTable)
    {
        return $dataTable->render('front.layouts.perumahan');
    }

    public function indexxx(Request $request)
    {
        $perumahans = PerumahanModel::orderBy('id', 'DESC')->paginate(20);
        return view('front.layouts.perumahan', compact('perumahans'));
    }

    public function getData(Request $request)
    {
        $perumahans = PerumahanModel::orderBy('id', 'DESC')->paginate(20);
        return view('front.layouts.perumahan', compact('perumahans'));
    }

    public function create(Request $request)
    {
        $kategoriPsus = KategoriPsuModel::get();
        if($request->ajax()){
            return view('front.layouts.perumahan-create', compact('kategoriPsus'));
        }else{
            return view('front.layouts.perumahan', compact('kategoriPsus'));
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            //'provinsi_id' => 'required',
            'kabkota_id' => 'required',
            'kecamatan_id' => 'required',
            'kelurahan_id' => 'required',
            //'pengembang_id' => 'required',
            'nama_perumahan' => 'required',
            'luas' => '',
            'tahun_siteplan' => '',
            'latitude' => '',
            'longitude' => '',
            //'latlong' => '',
            'total_unit' => '',
            'jumlah_mbr' => '',
            'jumlah_nonmbr' => '',
            'no_bast' => '',
            'file_bast' => 'file|mimes:jpg,jpeg,png,pdf',
            'photo' => 'file|mimes:jpg,jpeg,png',
            'siteplan' => 'file|mimes:jpg,jpeg,png',
            'alamat' => 'required',
            'status_data' => 'required',
            'nama_pengembang' => 'required',
            'telepon_pengembang' => '',
            'email_pengembang' => '',
            'jumlah_proses' => '',
            'jumlah_ditempati' => '',
            'jumlah_kosong' => '',
            //'user_id_create' => 'required',
            //'user_id_update' => 'required',
            //'created_at' => 'required',
            //'updated_at' => 'required',
        ]);

        $file_bast = '';
        $photo = '';
        $siteplan = '';
        
        if ($request->file('file_bast')) {
            $file = $request->file('file_bast');
            $path = $file->store('uploads/perumahan/file_bast', 'public');
            //$file_bast = $file->getClientOriginalName();
            //$file_bast = basename($path);
            $file_bast = $path;
        }
        
        if ($request->file('photo')) {
            $file = $request->file('photo');
            $path = $file->store('uploads/perumahan/photo', 'public');
            //$photo = $file->getClientOriginalName();
            //$photo = basename($path);
            $photo = $path;
        }
        
        if ($request->file('siteplan')) {
            $file = $request->file('siteplan');
            $path = $file->store('uploads/perumahan/siteplan', 'public');
            //$siteplan = $file->getClientOriginalName();
            //$siteplan = basename($path);
            $siteplan = $path;
        }
        

        //$fileModel = new File;
        //$fileModel->name = $file->getClientOriginalName();
        //$fileModel->path = $path;
        //$fileModel->save();

        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $latlong = (empty($latitude.$longitude))?null:new Point($latitude,$longitude, Srid::WGS84->value);

        $user_id = Auth::user()->id;
        $dt = [
            'provinsi_id' => 63,
            'kabkota_id' => $request->input('kabkota_id'),
            'kecamatan_id' => $request->input('kecamatan_id'),
            'kelurahan_id' => $request->input('kelurahan_id'),
            //'pengembang_id' => $request->input('pengembang_id'),
            'nama_perumahan' => $request->input('nama_perumahan'),
            'luas' => $request->input('luas'),
            'tahun_siteplan' => $request->input('tahun_siteplan'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'latlong' => $latlong,
            'total_unit' => $request->input('total_unit'),
            'jumlah_mbr' => $request->input('jumlah_mbr'),
            'jumlah_nonmbr' => $request->input('jumlah_nonmbr'),
            'no_bast' => $request->input('no_bast'),
            //'file_bast' => $request->input('file_bast'),
            //'photo' => $request->input('photo'),
            //'siteplan' => $request->input('siteplan'),
            'alamat' => $request->input('alamat'),
            'status_data' => $request->input('status_data'),
            'nama_pengembang' => $request->input('nama_pengembang'),
            'telepon_pengembang' => $request->input('telepon_pengembang'),
            'email_pengembang' => $request->input('email_pengembang'),
            'jumlah_proses' => $request->input('jumlah_proses'),
            'jumlah_ditempati' => $request->input('jumlah_ditempati'),
            'jumlah_kosong' => $request->input('jumlah_kosong'),
            'user_id_create' => $user_id,
            'user_id_update' => $user_id,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];

        if(!empty($file_bast))
        {
            $dt['file_bast'] = $file_bast;
        }
        if(!empty($photo))
        {
            $dt['photo'] = $photo;
        }
        if(!empty($siteplan))
        {
            $dt['siteplan'] = $siteplan;
        }

        $perumahan = PerumahanModel::create($dt);

        return redirect()->route('admin.perumahan.index')
            ->with('success', 'Perumahan berhasil disimpan');
    }

    public function show($id,Request $request)
    {
        $perumahan = PerumahanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if($request->ajax()){
            return view('front.layouts.perumahan-show', compact('perumahan', 'kategoriPsus'));
        }else{
            return view('front.layouts.perumahan', compact('perumahan', 'kategoriPsus'));
        }
    }

    
    public function peta($id,Request $request)
    {
        $perumahan = PerumahanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if($request->ajax()){
            return view('front.layouts.perumahan-peta', compact('perumahan', 'kategoriPsus'));
        }else{
            return view('front.layouts.perumahan', compact('perumahan', 'kategoriPsus'));
        }
    }
    
    public function psu($id,Request $request)
    {
        $perumahan = PerumahanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if($request->ajax()){
            return view('front.layouts.perumahan-psu', compact('perumahan', 'kategoriPsus'));
        }else{
            return view('front.layouts.perumahan', compact('perumahan', 'kategoriPsus'));
        }
    }
    
    public function print($id,Request $request)
    {
        $perumahan = PerumahanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        
        if($request->ajax()){
            return view('front.layouts.perumahan-print', compact('perumahan', 'kategoriPsus'));
        }else{
            return view('front.layouts.perumahan', compact('perumahan', 'kategoriPsus'));
        }
    }
    
    public function document($id,Request $request)
    {
        $perumahan = PerumahanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if($request->ajax()){
            return view('front.layouts.perumahan-document', compact('perumahan', 'kategoriPsus'));
        }else{
            return view('front.layouts.perumahan', compact('perumahan', 'kategoriPsus'));
        }
    }
    
    public function pdf($id,Request $request)
    {
        $perumahan = PerumahanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        $pdf = PDF::loadView('front.layouts.perumahan', compact('perumahan', 'kategoriPsus'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download(Str::kebab($perumahan->nama_percumahan).'.pdf');

        if($request->ajax()){
            return view('front.layouts.perumahan-print', compact('perumahan', 'kategoriPsus'));
        }else{
            return view('front.layouts.perumahan', compact('perumahan', 'kategoriPsus'));
        }
    }

    public function edit($id,Request $request)
    {
        $perumahan = PerumahanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if($request->ajax()){
            return view('front.layouts.perumahan-edit', compact('perumahan', 'kategoriPsus'));
        }else{
            return view('front.layouts.perumahan', compact('perumahan', 'kategoriPsus'));
        }
    }

    public function psuDetail($id,Request $request)
    {
        $perumahan = PerumahanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if($request->ajax()){
            return view('front.layouts.perumahan-psu-detail', compact('perumahan', 'kategoriPsus'));
        }else{
            return view('front.layouts.perumahan-detail', compact('perumahan', 'kategoriPsus'));
        }
    }
    
    public function formUploadPeta($id,Request $request)
    {
        $perumahan = PerumahanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if($request->ajax()){
            return view('front.layouts.perumahan-upload-peta', compact('perumahan', 'kategoriPsus'));
        }else{
            return view('front.layouts.perumahan-peta', compact('perumahan', 'kategoriPsus'));
        }
    }

    public function formUploadDokumen($id,Request $request)
    {
        $perumahan = PerumahanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if($request->ajax()){
            return view('front.layouts.perumahan-upload-dokumen', compact('perumahan', 'kategoriPsus'));
        }else{
            return view('front.layouts.perumahan-dokumen', compact('perumahan', 'kategoriPsus'));
        }
    }

    public function saveGeojson($id,Request $request)
    {
        $this->validate($request, [
            'geometry_file' => 'required', //|mimes:zip,sbx,shp,shp.xml,shx,cpg,dbf,prj,sbn,geojson,json',
        ]);
        
        $user_id = Auth::user()->id;

        $geojson = json_decode(file_get_contents($request->input('geometry_file')),true);

        $perumahan = PerumahanModel::find($id);
        $perumahan->user_id_update = $user_id;
        $perumahan->geometry_file =$request->input('geometry_file');
        $perumahan->geometry = $geojson;
        $perumahan->save();

        return $perumahan->toJson();
    }

    public function uploadPeta($id,Request $request)
    {
        $this->validate($request, [
            'file' => 'file', //|mimes:zip,sbx,shp,shp.xml,shx,cpg,dbf,prj,sbn,geojson,json',
        ]);

        $path = '';
        $uploadPath = '';
        
        if ($request->file('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $name = $file->getClientOriginalName();
            $uploadPath = 'public/uploads/perumahan/peta/'.$id ; //.'/'.$name.'.'.$extension;
            //$path = $file->storeAs($uploadPath, 'public');
            $path = $file->storeAs($uploadPath, $file->getClientOriginalName());
            return $path;
            //$file_bast = $file->getClientOriginalName();
            //$file_bast = basename($path);
        }
        
        $perumahan = PerumahanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        $opath = 'uploads/perumahan/peta/'.$id.'/geojson/'.$id.'.geojson';
        $inputPath = storage_path($path);
        $outputPath = storage_path($opath);

        // Jalankan command Artisan untuk konversi
        /* $artistanO = Artisan::call('convert:shapefile', [
            'input' => $inputPath,
            'output' => $outputPath
        ]); */

        return asset(Storage::url($opath)); //[Storage::url($opath),$outputPath,$artistanO];
    }

    public function uploadDokumen($id,Request $request)
    {
        $this->validate($request, [
            'file' => 'file|mimes:zip,jpg,jpeg,png,doc,docx,xls,xlxs,pdf',
            'id_perumahan' => 'required',
            'nama_file' => '',
            'judul_file' => '',
        ]);

        $path = '';
        $uploadPath = '';
        
        if ($request->file('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $name = $file->getClientOriginalName();
            $uploadPath = 'public/uploads/perumahan/dokumen/'.$id ; //.'/'.$name.'.'.$extension;
            $path = $file->storeAs($uploadPath, $file->getClientOriginalName());
        }
        
        $dt = [
            'nama_file' => $path,
            'id_perumahan' => $id,
            'judul_file' => basename($path),
        ];

        $dokumen = PerumahanDokumenModel::create($dt);

        return $dokumen->toJson(); //[Storage::url($opath),$outputPath,$artistanO];
    }

    public function generateShp($id,Request $request){
        $files = $request->input('files');

        $shp = false;
        $shx = false;
        $geojson = false;

        if(!empty($files) and is_array($files) and count($files) > 0)
        {
            foreach($files as $i => $f)
            {
                $f_arr = explode(".",$f);
                $ext = $f_arr[count($f_arr) - 1];
                if($ext == 'shp'){
                    $shp = $f;
                }
                if($ext == 'shx'){
                    $shx = $f;
                }
            }
        }

        //exec("C:/OSGeo4W/bin/ogr2ogr.exe -f GeoJSON C:\wamp\www\si-psu-new\storage\public/uploads/perumahan/peta/6/6.geojson C:\wamp\www\si-psu-new\storage\public/uploads/perumahan/peta/6/Pondok_Indah_V.shp",$output,$result_code);
        //dd($output,$result_code);

        if($shp && $shx)
        {
            $uploadPath = 'app/public/uploads/perumahan/peta/'.$id.'/'.$shp;
            Artisan::call('convert:shapefile', [
                'input' => storage_path($uploadPath),
                'output' => storage_path('app/public/uploads/perumahan/peta/'.$id.'/'.$id.'.geojson')
            ]);

            return asset(Storage::url('public/uploads/perumahan/peta/'.$id.'/'.$id.'.geojson'));

        }else{
            return [$shp,$shx];
        }

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            #'provinsi_id' => 'required',
            'kabkota_id' => 'required',
            'kecamatan_id' => 'required',
            'kelurahan_id' => 'required',
            //'pengembang_id' => '',
            'nama_perumahan' => 'required',
            'luas' => '',
            'tahun_siteplan' => '',
            'latitude' => '',
            'longitude' => '',
            //'latlong' => 'required',
            'total_unit' => '',
            'jumlah_mbr' => '',
            'jumlah_nonmbr' => '',
            'no_bast' => '',
            'file_bast' => 'file|mimes:jpg,jpeg,png,pdf',
            'photo' => 'file|mimes:jpg,jpeg,png',
            'siteplan' => 'file|mimes:jpg,jpeg,png',
            'alamat' => 'required',
            'status_data' => 'required',
            'nama_pengembang' => 'required',
            'telepon_pengembang' => '',
            'email_pengembang' => '',
            'jumlah_proses' => '',
            'jumlah_ditempati' => '',
            'jumlah_kosong' => '',
            //'user_id_create' => 'required',
            //'user_id_update' => 'required',
            //'created_at' => 'required',
            //'updated_at' => 'required',
        ]);

        $user_id = Auth::user()->id;

        $file_bast = '';
        $photo = '';
        $siteplan = '';
        
        if ($request->file('file_bast')) {
            $file = $request->file('file_bast');
            $path = $file->store('uploads/perumahan/file_bast', 'public');
            //$file_bast = $file->getClientOriginalName();
            //$file_bast = basename($path);
            $file_bast = $path;
        }
        
        if ($request->file('photo')) {
            $file = $request->file('photo');
            $path = $file->store('uploads/perumahan/photo', 'public');
            //$photo = $file->getClientOriginalName();
            //$photo = basename($path);
            $photo = $path;
        }
        
        if ($request->file('siteplan')) {
            $file = $request->file('siteplan');
            $path = $file->store('uploads/perumahan/siteplan', 'public');
            //$siteplan = $file->getClientOriginalName();
            //$siteplan = basename($path);
            $siteplan = $path;
        }
        
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $latlong = (empty($latitude.$longitude))?null:new Point($latitude,$longitude, Srid::WGS84->value);
        $perumahan = PerumahanModel::find($id);
        $perumahan->provinsi_id = 63;
        $perumahan->kabkota_id = $request->input('kabkota_id');
        $perumahan->kecamatan_id = $request->input('kecamatan_id');
        $perumahan->kelurahan_id = $request->input('kelurahan_id');
        //$perumahan->pengembang_id = $request->input('pengembang_id');
        $perumahan->nama_perumahan = $request->input('nama_perumahan');
        $perumahan->luas = $request->input('luas');
        $perumahan->tahun_siteplan = $request->input('tahun_siteplan');
        $perumahan->latitude = $request->input('latitude');
        $perumahan->longitude = $request->input('longitude');
        $perumahan->latlong = $latlong;
        $perumahan->total_unit = $request->input('total_unit');
        $perumahan->jumlah_mbr = $request->input('jumlah_mbr');
        $perumahan->jumlah_nonmbr = $request->input('jumlah_nonmbr');
        $perumahan->no_bast = $request->input('no_bast');
        //$perumahan->file_bast = $request->input('file_bast');
        //$perumahan->photo = $request->input('photo');
        //$perumahan->siteplan = $request->input('siteplan');
        $perumahan->alamat = $request->input('alamat');
        $perumahan->nama_pengembang = $request->input('nama_pengembang');
        $perumahan->telepon_pengembang = $request->input('telepon_pengembang');
        $perumahan->email_pengembang = $request->input('email_pengembang');
        $perumahan->jumlah_proses = $request->input('jumlah_proses');
        $perumahan->jumlah_ditempati = $request->input('jumlah_ditempati');
        $perumahan->jumlah_kosong = $request->input('jumlah_kosong');
        //$perumahan->user_id_create = $request->input('user_id_create');
        $perumahan->user_id_update = $user_id;
        //$perumahan->created_at = $request->input('created_at');
        $perumahan->updated_at = date("Y-m-d H:i:s");
        
        if(!empty($file_bast))
        {
            $perumahan->file_bast = $file_bast;
        }
        if(!empty($photo))
        {
            $perumahan->photo = $photo;
        }
        if(!empty($siteplan))
        {
            $perumahan->siteplan = $siteplan;
        }


        $perumahan->save();


        return redirect()->route('admin.perumahan.index')
            ->with('success', 'Perumahan berhasil diubah');
    }

    public function destroy(PerumahanModel $perumahan, Request $request)
    {
        $perumahan->delete();
        return redirect()->route('admin.perumahan.index')
            ->with('success', 'Perumahan telah dihapus');
    }
}
