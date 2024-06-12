<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\PsuModel;
use App\DataTables\Front\PsuDataTable;
use App\Models\KategoriPsuModel;
use App\Models\PsuDokumenModel;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Enums\Srid;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use DB;
use Auth;
use Str;
use PDF;

class FrontPsuController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index(PsuDataTable $dataTable)
    {
        return $dataTable->render('front.layouts.psu');
    }

    public function indexxx(Request $request)
    {
        $psus = PsuModel::orderBy('id', 'DESC')->paginate(20);
        return view('front.layouts.psu', compact('psus'));
    }

    public function getData(Request $request)
    {
        $psus = PsuModel::orderBy('id', 'DESC')->paginate(20);
        return view('front.layouts.psu', compact('psus'));
    }

    public function create(Request $request)
    {
        $kategoriPsus = KategoriPsuModel::get();
        if($request->ajax()){
            return view('front.layouts.psu-create', compact('kategoriPsus'));
        }else{
            return view('front.layouts.psu', compact('kategoriPsus'));
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
            'nama_psu' => 'required',
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
            $path = $file->store('uploads/psu/file_bast', 'public');
            //$file_bast = $file->getClientOriginalName();
            //$file_bast = basename($path);
            $file_bast = $path;
        }
        
        if ($request->file('photo')) {
            $file = $request->file('photo');
            $path = $file->store('uploads/psu/photo', 'public');
            //$photo = $file->getClientOriginalName();
            //$photo = basename($path);
            $photo = $path;
        }
        
        if ($request->file('siteplan')) {
            $file = $request->file('siteplan');
            $path = $file->store('uploads/psu/siteplan', 'public');
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
            'nama_psu' => $request->input('nama_psu'),
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

        $psu = PsuModel::create($dt);

        return redirect()->route('admin.psu.index')
            ->with('success', 'Psu berhasil disimpan');
    }

    public function show($id,Request $request)
    {
        $psu = PsuModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if($request->ajax()){
            return view('front.layouts.psu-show', compact('psu', 'kategoriPsus'));
        }else{
            return view('front.layouts.psu', compact('psu', 'kategoriPsus'));
        }
    }

    
    public function peta($id,Request $request)
    {
        $psu = PsuModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if($request->ajax()){
            return view('front.layouts.psu-peta', compact('psu', 'kategoriPsus'));
        }else{
            return view('front.layouts.psu', compact('psu', 'kategoriPsus'));
        }
    }
    
    public function psu($id,Request $request)
    {
        $psu = PsuModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if($request->ajax()){
            return view('front.layouts.psu-psu', compact('psu', 'kategoriPsus'));
        }else{
            return view('front.layouts.psu', compact('psu', 'kategoriPsus'));
        }
    }
    
    public function print($id,Request $request)
    {
        $psu = PsuModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        
        if($request->ajax()){
            return view('front.layouts.psu-print', compact('psu', 'kategoriPsus'));
        }else{
            return view('front.layouts.psu', compact('psu', 'kategoriPsus'));
        }
    }
    
    public function document($id,Request $request)
    {
        $psu = PsuModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if($request->ajax()){
            return view('front.layouts.psu-document', compact('psu', 'kategoriPsus'));
        }else{
            return view('front.layouts.psu', compact('psu', 'kategoriPsus'));
        }
    }
    
    public function pdf($id,Request $request)
    {
        $psu = PsuModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        $pdf = PDF::loadView('front.layouts.psu', compact('psu', 'kategoriPsus'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download(Str::kebab($psu->nama_percumahan).'.pdf');

        if($request->ajax()){
            return view('front.layouts.psu-print', compact('psu', 'kategoriPsus'));
        }else{
            return view('front.layouts.psu', compact('psu', 'kategoriPsus'));
        }
    }

    public function edit($id,Request $request)
    {
        $psu = PsuModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if($request->ajax()){
            return view('front.layouts.psu-edit', compact('psu', 'kategoriPsus'));
        }else{
            return view('front.layouts.psu', compact('psu', 'kategoriPsus'));
        }
    }

    public function psuDetail($id,Request $request)
    {
        $psu = PsuModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if($request->ajax()){
            return view('front.layouts.psu-psu-detail', compact('psu', 'kategoriPsus'));
        }else{
            return view('front.layouts.psu-detail', compact('psu', 'kategoriPsus'));
        }
    }
    
    public function formUploadPeta($id,Request $request)
    {
        $psu = PsuModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if($request->ajax()){
            return view('front.layouts.psu-upload-peta', compact('psu', 'kategoriPsus'));
        }else{
            return view('front.layouts.psu-peta', compact('psu', 'kategoriPsus'));
        }
    }

    public function formUploadDokumen($id,Request $request)
    {
        $psu = PsuModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if($request->ajax()){
            return view('front.layouts.psu-upload-dokumen', compact('psu', 'kategoriPsus'));
        }else{
            return view('front.layouts.psu-dokumen', compact('psu', 'kategoriPsus'));
        }
    }

    public function saveGeojson($id,Request $request)
    {
        $this->validate($request, [
            'geometry_file' => 'required', //|mimes:zip,sbx,shp,shp.xml,shx,cpg,dbf,prj,sbn,geojson,json',
        ]);
        
        $user_id = Auth::user()->id;

        $geojson = json_decode(file_get_contents($request->input('geometry_file')),true);

        $psu = PsuModel::find($id);
        $psu->user_id_update = $user_id;
        $psu->geometry_file =$request->input('geometry_file');
        $psu->geometry = $geojson;
        $psu->save();

        return $psu->toJson();
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
            $uploadPath = 'public/uploads/psu/peta/'.$id ; //.'/'.$name.'.'.$extension;
            //$path = $file->storeAs($uploadPath, 'public');
            $path = $file->storeAs($uploadPath, $file->getClientOriginalName());
            return $path;
            //$file_bast = $file->getClientOriginalName();
            //$file_bast = basename($path);
        }
        
        $psu = PsuModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        $opath = 'uploads/psu/peta/'.$id.'/geojson/'.$id.'.geojson';
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
            'id_psu' => 'required',
            'nama_file' => '',
            'judul_file' => '',
        ]);

        $path = '';
        $uploadPath = '';
        
        if ($request->file('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $name = $file->getClientOriginalName();
            $uploadPath = 'public/uploads/psu/dokumen/'.$id ; //.'/'.$name.'.'.$extension;
            $path = $file->storeAs($uploadPath, $file->getClientOriginalName());
        }
        
        $dt = [
            'nama_file' => $path,
            'id_psu' => $id,
            'judul_file' => basename($path),
        ];

        $dokumen = PsuDokumenModel::create($dt);

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

        //exec("C:/OSGeo4W/bin/ogr2ogr.exe -f GeoJSON C:\wamp\www\si-psu-new\storage\public/uploads/psu/peta/6/6.geojson C:\wamp\www\si-psu-new\storage\public/uploads/psu/peta/6/Pondok_Indah_V.shp",$output,$result_code);
        //dd($output,$result_code);

        if($shp && $shx)
        {
            $uploadPath = 'app/public/uploads/psu/peta/'.$id.'/'.$shp;
            Artisan::call('convert:shapefile', [
                'input' => storage_path($uploadPath),
                'output' => storage_path('app/public/uploads/psu/peta/'.$id.'/'.$id.'.geojson')
            ]);

            return asset(Storage::url('public/uploads/psu/peta/'.$id.'/'.$id.'.geojson'));

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
            'nama_psu' => 'required',
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
            $path = $file->store('uploads/psu/file_bast', 'public');
            //$file_bast = $file->getClientOriginalName();
            //$file_bast = basename($path);
            $file_bast = $path;
        }
        
        if ($request->file('photo')) {
            $file = $request->file('photo');
            $path = $file->store('uploads/psu/photo', 'public');
            //$photo = $file->getClientOriginalName();
            //$photo = basename($path);
            $photo = $path;
        }
        
        if ($request->file('siteplan')) {
            $file = $request->file('siteplan');
            $path = $file->store('uploads/psu/siteplan', 'public');
            //$siteplan = $file->getClientOriginalName();
            //$siteplan = basename($path);
            $siteplan = $path;
        }
        
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $latlong = (empty($latitude.$longitude))?null:new Point($latitude,$longitude, Srid::WGS84->value);
        $psu = PsuModel::find($id);
        $psu->provinsi_id = 63;
        $psu->kabkota_id = $request->input('kabkota_id');
        $psu->kecamatan_id = $request->input('kecamatan_id');
        $psu->kelurahan_id = $request->input('kelurahan_id');
        //$psu->pengembang_id = $request->input('pengembang_id');
        $psu->nama_psu = $request->input('nama_psu');
        $psu->luas = $request->input('luas');
        $psu->tahun_siteplan = $request->input('tahun_siteplan');
        $psu->latitude = $request->input('latitude');
        $psu->longitude = $request->input('longitude');
        $psu->latlong = $latlong;
        $psu->total_unit = $request->input('total_unit');
        $psu->jumlah_mbr = $request->input('jumlah_mbr');
        $psu->jumlah_nonmbr = $request->input('jumlah_nonmbr');
        $psu->no_bast = $request->input('no_bast');
        //$psu->file_bast = $request->input('file_bast');
        //$psu->photo = $request->input('photo');
        //$psu->siteplan = $request->input('siteplan');
        $psu->alamat = $request->input('alamat');
        $psu->nama_pengembang = $request->input('nama_pengembang');
        $psu->telepon_pengembang = $request->input('telepon_pengembang');
        $psu->email_pengembang = $request->input('email_pengembang');
        $psu->jumlah_proses = $request->input('jumlah_proses');
        $psu->jumlah_ditempati = $request->input('jumlah_ditempati');
        $psu->jumlah_kosong = $request->input('jumlah_kosong');
        //$psu->user_id_create = $request->input('user_id_create');
        $psu->user_id_update = $user_id;
        //$psu->created_at = $request->input('created_at');
        $psu->updated_at = date("Y-m-d H:i:s");
        
        if(!empty($file_bast))
        {
            $psu->file_bast = $file_bast;
        }
        if(!empty($photo))
        {
            $psu->photo = $photo;
        }
        if(!empty($siteplan))
        {
            $psu->siteplan = $siteplan;
        }


        $psu->save();


        return redirect()->route('admin.psu.index')
            ->with('success', 'Psu berhasil diubah');
    }

    public function destroy(PsuModel $psu, Request $request)
    {
        $psu->delete();
        return redirect()->route('admin.psu.index')
            ->with('success', 'Psu telah dihapus');
    }
}
