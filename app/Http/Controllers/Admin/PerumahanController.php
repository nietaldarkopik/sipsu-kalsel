<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\PsuAttributeModel;
use App\Models\PsuAttributePerumahanModel;
use Illuminate\Http\Request;
use App\Models\PerumahanModel;
use App\DataTables\PerumahansDataTable;
use App\Models\KategoriPsuModel;
use App\Models\PerumahanDokumenModel;
use MatanYadaev\EloquentSpatial\Objects\Polygon;
use MatanYadaev\EloquentSpatial\Objects\LineString;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Enums\Srid;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use App\Imports\PermukimansImport;
use App\Imports\PerumahansImport;
use App\Models\JenisPsuModel;
use App\Models\PsuModel;
use App\Models\PsuPerumahanModel;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Auth;
use GuzzleHttp\Psr7\Query;
use Str;
use PDF;

class PerumahanController extends Controller
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

    public function index(PerumahansDataTable $dataTable)
    {
        return $dataTable->render('vendor.adminlte.perumahans.index');
    }

    public function indexxx(Request $request)
    {
        $perumahans = PerumahanModel::orderBy('id', 'DESC')->paginate(20);
        return view('vendor.adminlte.perumahans.index', compact('perumahans'));
    }

    public function getData(Request $request)
    {
        $perumahans = PerumahanModel::orderBy('id', 'DESC')->paginate(20);
        return view('vendor.adminlte.perumahans.index', compact('perumahans'));
    }

    public function create(Request $request)
    {
        $kategoriPsus = KategoriPsuModel::get();
        if ($request->ajax()) {
            return view('vendor.adminlte.perumahans.form-create', compact('kategoriPsus'));
        } else {
            return view('vendor.adminlte.perumahans.create', compact('kategoriPsus'));
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
        $latlong = (empty($latitude . $longitude)) ? null : new Point($latitude, $longitude, Srid::WGS84->value);

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

        if (!empty($file_bast)) {
            $dt['file_bast'] = $file_bast;
        }
        if (!empty($photo)) {
            $dt['photo'] = $photo;
        }
        if (!empty($siteplan)) {
            $dt['siteplan'] = $siteplan;
        }

        $perumahan = PerumahanModel::create($dt);

        return redirect()->route('admin.perumahan.index')
            ->with('success', 'Perumahan berhasil disimpan');
    }

    public function show($id, Request $request)
    {
        $perumahan = PerumahanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if ($request->ajax()) {
            return view('vendor.adminlte.perumahans.form-show', compact('perumahan', 'kategoriPsus'));
        } else {
            return view('vendor.adminlte.perumahans.show', compact('perumahan', 'kategoriPsus'));
        }
    }


    public function peta($id, Request $request)
    {
        $perumahan = PerumahanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if ($request->ajax()) {
            return view('vendor.adminlte.perumahans.form-peta', compact('perumahan', 'kategoriPsus'));
        } else {
            return view('vendor.adminlte.perumahans.peta', compact('perumahan', 'kategoriPsus'));
        }
    }

    public function psu($id, Request $request)
    {
        $perumahan = PerumahanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if ($request->ajax()) {
            return view('vendor.adminlte.perumahans.form-psu', compact('perumahan', 'kategoriPsus'));
        } else {
            return view('vendor.adminlte.perumahans.psu', compact('perumahan', 'kategoriPsus'));
        }
    }

    public function print($id, Request $request)
    {
        $perumahan = PerumahanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();


        if ($request->ajax()) {
            return view('vendor.adminlte.perumahans.form-print', compact('perumahan', 'kategoriPsus'));
        } else {
            return view('vendor.adminlte.perumahans.print', compact('perumahan', 'kategoriPsus'));
        }
    }

    public function document($id, Request $request)
    {
        $perumahan = PerumahanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if ($request->ajax()) {
            return view('vendor.adminlte.perumahans.form-document', compact('perumahan', 'kategoriPsus'));
        } else {
            return view('vendor.adminlte.perumahans.document', compact('perumahan', 'kategoriPsus'));
        }
    }

    public function pdf($id, Request $request)
    {
        $perumahan = PerumahanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        $pdf = PDF::loadView('vendor.adminlte.perumahans.pdf', compact('perumahan', 'kategoriPsus'))->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download(Str::kebab($perumahan->nama_percumahan) . '.pdf');

        if ($request->ajax()) {
            return view('vendor.adminlte.perumahans.form-print', compact('perumahan', 'kategoriPsus'));
        } else {
            return view('vendor.adminlte.perumahans.print', compact('perumahan', 'kategoriPsus'));
        }
    }

    public function edit($id, Request $request)
    {
        $perumahan = PerumahanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if ($request->ajax()) {
            return view('vendor.adminlte.perumahans.form-edit', compact('perumahan', 'kategoriPsus'));
        } else {
            return view('vendor.adminlte.perumahans.edit', compact('perumahan', 'kategoriPsus'));
        }
    }

    public function psuDetail($id, Request $request)
    {
        $perumahan = PerumahanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if ($request->ajax()) {
            return view('vendor.adminlte.perumahans.form-psu-detail', compact('perumahan', 'kategoriPsus'));
        } else {
            return view('vendor.adminlte.perumahans.psu-detail', compact('perumahan', 'kategoriPsus'));
        }
    }

    public function formUploadPeta($id, Request $request)
    {
        $perumahan = PerumahanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if ($request->ajax()) {
            return view('vendor.adminlte.perumahans.form-upload-peta', compact('perumahan', 'kategoriPsus'));
        } else {
            return view('vendor.adminlte.perumahans.upload-peta', compact('perumahan', 'kategoriPsus'));
        }
    }

    public function formUploadDokumen($id, Request $request)
    {
        $perumahan = PerumahanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        if ($request->ajax()) {
            return view('vendor.adminlte.perumahans.form-document', compact('perumahan', 'kategoriPsus'));
        } else {
            return view('vendor.adminlte.perumahans.document', compact('perumahan', 'kategoriPsus'));
        }
    }

    public function formImport(Request $request)
    {
        $kategoriPsus = KategoriPsuModel::get();

        if ($request->ajax()) {
            return view('vendor.adminlte.perumahans.form-import', compact('kategoriPsus'));
        } else {
            return view('vendor.adminlte.perumahans.import', compact('kategoriPsus'));
        }
    }

    public function saveGeojson($id, Request $request)
    {
        $this->validate($request, [
            'geometry_file' => 'required', //|mimes:zip,sbx,shp,shp.xml,shx,cpg,dbf,prj,sbn,geojson,json',
        ]);

        $user_id = Auth::user()->id;

        $geojson = json_decode(file_get_contents($request->input('geometry_file')), true);

        $perumahan = PerumahanModel::find($id);
        $perumahan->user_id_update = $user_id;
        $perumahan->geometry_file = $request->input('geometry_file');
        $perumahan->geometry = $geojson;
        $perumahan->save();

        return $perumahan->toJson();
    }

    public function uploadPeta($id, Request $request)
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
            $uploadPath = 'public/uploads/perumahan/peta/' . $id; //.'/'.$name.'.'.$extension;
            //$path = $file->storeAs($uploadPath, 'public');
            $path = $file->storeAs($uploadPath, $file->getClientOriginalName());
            return $path;
            //$file_bast = $file->getClientOriginalName();
            //$file_bast = basename($path);
        }

        $perumahan = PerumahanModel::find($id);
        $kategoriPsus = KategoriPsuModel::get();

        $opath = 'uploads/perumahan/peta/' . $id . '/geojson/' . $id . '.geojson';
        $inputPath = storage_path($path);
        $outputPath = storage_path($opath);

        // Jalankan command Artisan untuk konversi
        /* $artistanO = Artisan::call('convert:shapefile', [
            'input' => $inputPath,
            'output' => $outputPath
        ]); */

        return asset(Storage::url($opath)); //[Storage::url($opath),$outputPath,$artistanO];
    }

    public function uploadDokumen($id, Request $request)
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
            $uploadPath = 'public/uploads/perumahan/dokumen/' . $id; //.'/'.$name.'.'.$extension;
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

    public function generateShp($id, Request $request)
    {
        $files = $request->input('files');

        $shp = false;
        $shx = false;
        $geojson = false;

        if (!empty($files) and is_array($files) and count($files) > 0) {
            foreach ($files as $i => $f) {
                $f_arr = explode(".", $f);
                $ext = $f_arr[count($f_arr) - 1];
                if ($ext == 'shp') {
                    $shp = $f;
                }
                if ($ext == 'shx') {
                    $shx = $f;
                }
            }
        }

        //exec("C:/OSGeo4W/bin/ogr2ogr.exe -f GeoJSON C:\wamp\www\si-psu-new\storage\public/uploads/perumahan/peta/6/6.geojson C:\wamp\www\si-psu-new\storage\public/uploads/perumahan/peta/6/Pondok_Indah_V.shp",$output,$result_code);
        //dd($output,$result_code);

        if ($shp && $shx) {
            $uploadPath = 'app/public/uploads/perumahan/peta/' . $id . '/' . $shp;
            Artisan::call('convert:shapefile', [
                'input' => storage_path($uploadPath),
                'output' => storage_path('app/public/uploads/perumahan/peta/' . $id . '/' . $id . '.geojson')
            ]);

            return asset(Storage::url('public/uploads/perumahan/peta/' . $id . '/' . $id . '.geojson'));

        } else {
            return [$shp, $shx];
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
        $latlong = (empty($latitude . $longitude)) ? null : new Point($latitude, $longitude, Srid::WGS84->value);
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

        if (!empty($file_bast)) {
            $perumahan->file_bast = $file_bast;
        }
        if (!empty($photo)) {
            $perumahan->photo = $photo;
        }
        if (!empty($siteplan)) {
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


    public function storeImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        //$rows = Excel::toCollection(new PerumahansImport, $request->file('file'));
        $rows = Excel::toArray(new PerumahansImport, $request->file('file'));
        $data = [];

        $user_id = Auth::user()->id;
        $psu_perumahan = [];
        foreach ($rows[0] as $i => $row) {
            if ($i < 2 || (is_array($row) && implode("", $row) == ''))
                continue;
            //0	$data['no']
            //1	$data['nama_perumahan']
            //2	$data['nama_developer']
            //3	$data['alamat']
            //4	$data['kelurahan']
            //5	$data['kecamatan']
            //6	$data['koordinat']['x']
            //7	$data['koordinat']['y']
            //8	$data['jumlah_rumah']['total']
            //9	$data['jumlah_rumah']['proses']
            //10	$data['jumlah_rumah']['ditempati']
            //11	$data['jumlah_rumah']['kosong']
            //12	$data['kondisi_jalan']['panjang']
            //13	$data['kondisi_jalan']['lebar']
            //14	$data['kondisi_jalan']['perkerasan']
            //15	$data['kondisi_jalan']['jenis_perkerasan']
            //16	$data['kondisi_jalan']['kondisi']
            //17	$data['kondisi_drainase']['panjang']
            //18	$data['kondisi_drainase']['jenis']
            //19	$data['kondisi_drainase']['kondisi']
            //20	$data['jaringan_limbah']['jenis']
            //21	$data['jaringan_limbah']['kondisi']
            //22	$data['jaringan_listrik']['jenis']
            //23	$data['jaringan_listrik']['kondisi']
            //24	$data['jaringan_telekomunikasi']['jenis']
            //25	$data['jaringan_telekomunikasi']['kondisi']
            //26	$data['sumber_air_bersih']
            //27	$data['persampahan']
            //28	$data['pju']['ada']
            //29	$data['pju']['tidak_ada']
            //30	$data['ruang_terbuka_hijau']['jenis']
            //31	$data['ruang_terbuka_hijau']['luas']
            //32	$data['peribadatan']['jenis']
            //33	$data['peribadatan']['keterangan']
            //34	$data['peribadatan']['luas']
            //35	$data['pendidikan']['jenis']
            //36	$data['pendidikan']['keterangan']
            //37	$data['pendidikan']['luas']
            //38	$data['sosial']['jenis']
            //39	$data['sosial']['keterangan']
            //40	$data['sosial']['luas']
            //41	$data['olah_raga']['jenis']
            //42	$data['olah_raga']['keterangan']
            //43	$data['olah_raga']['luas']
            //44	$data['kesehatan']['jenis']
            //45	$data['kesehatan']['keterangan']
            //46	$data['kesehatan']['luas']
            //47	$data['keterangan']

            //5	$data['kecamatan']
            //4	$data['kelurahan']

            $kecamatan = $row[5];
            $kelurahan = $row[4];

            $kabkota_id = 0;
            $kecamatan_id = 0; //5	$data['kecamatan']
            $kelurahan_id = 0; //4	$data['kelurahan']
            $nama_perumahan = $row[1];
            $luas = 0;
            $tahun_siteplan = 0;
            $latitude = str_replace(',','.',$row[6]);
            $longitude = str_replace(',','.',$row[7]);
            $jumlah_mbr = 0;
            $jumlah_nonmbr = 0;
            $no_bast = '';
            $file_bast = '';
            $photo = '';
            $siteplan = '';
            $alamat = $row[3];
            $status_data = 'publik';
            $nama_pengembang = $row[2];
            $telepon_pengembang = '';
            $email_pengembang = '';
            $total_unit = (int) $row[8];
            $jumlah_proses = (int) $row[9];
            $jumlah_ditempati = (int) $row[10];
            $jumlah_kosong = (int) $row[11];
            $keterangan = $row[47];

            $latlong = (empty($latitude . $longitude)) ? null : new Point($latitude, $longitude, Srid::WGS84->value);
            
            $dkelurahan = DB::table('villages')
            ->join('districts','districts.id','villages.district_id')
            ->join('regencies','regencies.id','districts.regency_id')
            ->where(function($query) use( $kelurahan ) {
                /* $query->where('regencies.province_id','=',63); */
                $query->where('villages.name','ilike',"%$kelurahan%");
            })
            ->select(DB::raw('regencies.*, districts.*, villages.*'))
            ->get()->first();
            
            $psu = [];
            $psu['jalan']['panjang'] = $row[12];
            $psu['jalan']['lebar'] = $row[13];
            $psu['jalan']['perkerasan'] = $row[14];
            $psu['jalan']['jenis_perkerasan'] = $row[15];
            $psu['jalan']['jenis'] = '-';
            $psu['jalan']['kondisi'] = $row[16];
            $psu['drainase']['panjang'] = $row[17];
            $psu['drainase']['jenis'] = $row[18];
            $psu['drainase']['kondisi'] = $row[19];
            $psu['jaringan_limbah']['jenis'] = $row[20];
            $psu['jaringan_limbah']['kondisi'] = $row[21];
            $psu['jaringan_listrik']['jenis'] = $row[22];
            $psu['jaringan_listrik']['kondisi'] = $row[23];
            $psu['jaringan_telekomunikasi']['jenis'] = $row[24];
            $psu['jaringan_telekomunikasi']['kondisi'] = $row[25];
            $psu['sumber_air_bersih']['jenis'] = $row[26];
            $psu['sumber_air_bersih']['kondisi'] = '-';
            $psu['persampahan']['jenis'] = $row[27];
            $psu['persampahan']['kondisi'] = '-';
            $psu['sarana_penerangan_jalan_umum']['jenis'] = $row[28];
            $psu['sarana_penerangan_jalan_umum']['kondisi'] = $row[29];
            $psu['ruang_terbuka_hijau']['jenis'] = $row[30];
            $psu['ruang_terbuka_hijau']['luas'] = $row[31];
            $psu['ruang_terbuka_hijau']['kondisi'] = '-';
            $psu['peribadatan']['jenis'] = $row[32];
            $psu['peribadatan']['keterangan'] = $row[33];
            $psu['peribadatan']['luas'] = $row[34];
            $psu['peribadatan']['kondisi'] = '-';
            $psu['pendidikan']['jenis'] = $row[35];
            $psu['pendidikan']['keterangan'] = $row[36];
            $psu['pendidikan']['luas'] = $row[37];
            $psu['pendidikan']['kondisi'] = '-';
            $psu['pelayanan_umum_dan_pemerintahan']['jenis'] = $row[38];
            $psu['pelayanan_umum_dan_pemerintahan']['keterangan'] = $row[39];
            $psu['pelayanan_umum_dan_pemerintahan']['luas'] = $row[40];
            $psu['pelayanan_umum_dan_pemerintahan']['kondisi'] = '-';
            $psu['rekreasi_dan_olah_raga']['jenis'] = $row[41];
            $psu['rekreasi_dan_olah_raga']['keterangan'] = $row[42];
            $psu['rekreasi_dan_olah_raga']['luas'] = $row[43];
            $psu['rekreasi_dan_olah_raga']['kondisi'] = '-';
            $psu['kesehatan']['jenis'] = $row[44];
            $psu['kesehatan']['keterangan'] = $row[45];
            $psu['kesehatan']['luas'] = $row[46];
            $psu['kesehatan']['kondisi'] = '-';


            $perumahan = [
                'provinsi_id' => $dkelurahan?->province_id,
                'kabkota_id' => $dkelurahan?->regency_id,
                'kecamatan_id' => $dkelurahan?->district_id,
                'kelurahan_id' => $dkelurahan?->id,
                'nama_perumahan' => $nama_perumahan,
                'luas' => $luas,
                'tahun_siteplan' => $tahun_siteplan,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'latlong' => $latlong,
                'total_unit' => $total_unit,
                'jumlah_mbr' => $jumlah_mbr,
                'jumlah_nonmbr' => $jumlah_nonmbr,
                'no_bast' => $no_bast,
                'file_bast' => $file_bast,
                'photo' => $photo,
                'siteplan' => $siteplan,
                'alamat' => $alamat,
                'status_data' => $status_data,
                'nama_pengembang' => $nama_pengembang,
                'telepon_pengembang' => $telepon_pengembang,
                'email_pengembang' => $email_pengembang,
                'jumlah_proses' => $jumlah_proses,
                'jumlah_ditempati' => $jumlah_ditempati,
                'jumlah_kosong' => $jumlah_kosong,
                'keterangan' => $keterangan,
                'user_id_create' => $user_id,
            ];
            //$data[] = new PerumahanModel($perumahan);
            $new_perumahan = new PerumahanModel($perumahan);
            $new_perumahan->save();
            $data[] = $new_perumahan;

            foreach($psu as $ipsu => $p)
            {
                $tmp = [];
                $tmp['jenis_psu'] = trim(str_replace('_',' ',$ipsu));
                $tmp['psu'] = trim(str_replace('_',' ',(isset($p['jenis']) && $p['jenis'] != '-' && !empty($p['jenis']))?$p['jenis']:$ipsu));
                $tmp['id_perumahan'] = $new_perumahan?->id ?? 0;
                $djenis_psu = JenisPsuModel::where('title','ilike',('%'.str_replace(' ','%',$tmp['jenis_psu']).'%'))->firstOr(function() use ($p,$tmp) {
                    $kat = KategoriPsuModel::first();
                    return JenisPsuModel::create([
                    //return new JenisPsuModel([
                        'kategori' => $kat->id,
                        'title' => $tmp['jenis_psu']
                    ]);
                });
                $dpsu = PsuModel::where('judul','ilike',('%'.str_replace(' ','%',$tmp['psu']).'%'))->firstOr(function() use ($p,$tmp,$djenis_psu) {
                    return PsuModel::create([
                    //return new PsuModel([
                        'kategori' => $djenis_psu->kategori,
                        'jenis' => $djenis_psu->id,
                        'judul' => $tmp['psu']
                    ]);
                });

                $attrs = $p;
                if(isset($attrs['jenis'])) {unset($attrs['jenis']);}
                if(isset($attrs['keterangan'])) {unset($attrs['keterangan']);}
                if(isset($attrs['kondisi'])) {unset($attrs['kondisi']);}

                /* $kategori = KategoriPsuModel::where('title','ilike',$tmp['jenis_psu'])->firstOr(function() use ($p,$tmp) {
                    return KategoriPsuModel::create([
                        'title' => $tmp['jenis_psu']
                    ])
                }); */

                $id_kategori = $dpsu->kategori;
                $id_jenis_psu = $dpsu->jenis;
                $id_psu = $dpsu->id;
                $tmp["id_kategori"] = $id_kategori;
                $tmp["id_jenis_psu"] = $id_jenis_psu;
                $tmp["id_psu"] = $id_psu;
                $tmp["nama_psu"] = (isset($p['keterangan']))?$p['keterangan']:$tmp['psu'];
                $tmp["deskripsi"] = '';
                $tmp["jenis_permukiman"] = 'perumahan';
                $tmp["photo"] = '';
                //$tmp["latlong"] = '';
                $tmp["kondisi"] = (isset($p['kondisi']))?$p['kondisi']:'-';

                //$dpsu_perumahan = new PsuPerumahanModel($tmp);
                $dpsu_perumahan = PsuPerumahanModel::create($tmp);
                
                $dattributes = [];
                $dattribute_rumah = [];
                foreach($attrs as $iatr => $atr)
                {
                    $tmp_attribute = PsuAttributeModel::where(function($query) use ($p,$tmp,$djenis_psu,$dpsu,$iatr,$atr){
                        $query->where('id_kategori','=',$dpsu->kategori);
                        $query->where('id_jenis_psu','=',$dpsu->jenis);
                        $query->where('id_psu','=',$dpsu->id);
                        $query->where('attribute','ilike','%'.trim($iatr).'%');
                        //keterangan
                        //options
                    })->firstOr(function() use ($p,$tmp,$djenis_psu,$dpsu,$iatr,$atr) {
                        //return new PsuAttributeModel([
                        return PsuAttributeModel::create([
                            'id_kategori' => $dpsu->kategori,
                            'id_jenis_psu' => $dpsu->jenis,
                            'id_psu' => $dpsu->id,
                            'attribute' => Str::title(trim(trim($iatr))),
                            'keterangan' => '',
                            'options' => ''
                        ]);
                    });

                    
                    $dattributes[] = $tmp_attribute;

                    //$dattribute_rumah[] = new PsuAttributePerumahanModel([
                    $dattribute_rumah[] = PsuAttributePerumahanModel::create([
                        'id_perumahan' => $new_perumahan->id,
                        'id_jenis_psu' => $tmp_attribute->id_jenis_psu,
                        'id_psu' => $tmp_attribute->id_psu,
                        'id_psu_attribute' => $tmp_attribute->id,
                        'id_psu_perumahan' => $dpsu_perumahan->id,
                        'value' => $atr,
                    ]);
                }
                $psu_perumahan[] = [$djenis_psu, $dpsu, $dattributes, $dpsu_perumahan, $dattribute_rumah];
            }
        }

        return response()->json(["data" => $data,"count" => count($data),"messages" => (count($data) > 0)?count($data) . " Data berhasil diimport":"Data gagal di import","status" => (count($data) > 0)]);
        //return [$data,$psu_perumahan];

        //$rows = Excel::toCollection(new PerumahansImport, $request->file('file'));
        //$rows = Excel::toCollection(new PerumahansImport, $request->file('file'));

        //$data = Excel::toModel(new PerumahansImport, $request->file('file'));
        //dd($data);
        //Excel::import(new PerumahansImport, $request->file('file'));

        return back()->with('success', 'Data berhasil diimport.');
    }
}
