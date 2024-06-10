<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\HalamanController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\PerumahanController;
use App\Http\Controllers\Admin\PemukimanController;
use App\Http\Controllers\Admin\PsuController;
use App\Http\Controllers\Admin\PengajuanController;
use App\Http\Controllers\Admin\MonitoringController;
use App\Http\Controllers\Admin\KabupatenKotaController;
use App\Http\Controllers\Admin\KecamatanController;
use App\Http\Controllers\Admin\KelurahanController;
use App\Http\Controllers\Admin\KategoriPsuController;
use App\Http\Controllers\Admin\JenisPsuController;
use App\Http\Controllers\Admin\PsuPerumahanController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\UbahPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\Front\PageController::class,'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::prefix('admin')->name('admin.')->group(function(){
    Route::resource('halaman',HalamanController::class);
    Route::resource('menu',MenuController::class);
    Route::resource('faq',FaqController::class);
    Route::resource('perumahan',PerumahanController::class);
    Route::get('perumahan/{perumahan}/document',[PerumahanController::class,'document'])->name('perumahan.document');
    Route::get('perumahan/{perumahan}/peta',[PerumahanController::class,'peta'])->name('perumahan.peta');
    Route::get('perumahan/{perumahan}/psu',[PerumahanController::class,'psu'])->name('perumahan.psu');
    Route::get('perumahan/{perumahan}/print',[PerumahanController::class,'print'])->name('perumahan.print');
    Route::get('perumahan/{perumahan}/pdf',[PerumahanController::class,'pdf'])->name('perumahan.pdf');
    Route::get('perumahan/{perumahan}/psu-detail',[PerumahanController::class,'psuDetail'])->name('perumahan.psuDetail');
    Route::get('perumahan/{perumahan}/form-upload-peta',[PerumahanController::class,'formUploadPeta'])->name('perumahan.formUploadPeta');
    Route::get('perumahan/{perumahan}/form-upload-dokumen',[PerumahanController::class,'formUploadDokumen'])->name('perumahan.formUploadDokumen');
    Route::post('perumahan/{perumahan}/upload-peta',[PerumahanController::class,'uploadPeta'])->name('perumahan.uploadPeta');
    Route::post('perumahan/{perumahan}/upload-dokumen',[PerumahanController::class,'uploadDokumen'])->name('perumahan.uploadDokumen');
    Route::post('perumahan/{perumahan}/generate-geojson',[PerumahanController::class,'generateShp'])->name('perumahan.generateShp');
    Route::post('perumahan/{perumahan}/save-geojson',[PerumahanController::class,'saveGeojson'])->name('perumahan.saveGeojson');
    Route::resource('pemukiman',PemukimanController::class);
    Route::resource('psu',PsuController::class);
    Route::resource('pengajuan',PengajuanController::class);
    Route::resource('monitoring',MonitoringController::class);
    Route::resource('kabupaten-kota',KabupatenKotaController::class);
    Route::resource('kecamatan',KecamatanController::class);
    Route::resource('kelurahan',KelurahanController::class);
    Route::resource('kategori-psu',KategoriPsuController::class);
    Route::resource('jenis-psu',JenisPsuController::class);
    Route::resource('roles',RolesController::class);
    Route::resource('users',UsersController::class);
    Route::resource('ubah-password',UbahPasswordController::class);
    Route::resource('kategoripsu',KategoriPsuController::class);
    Route::resource('jenispsu',JenisPsuController::class);
    Route::get('services/get-kabupaten-kota',[ServicesController::class,'getKabupatenKota'])->name('services.getKabupatenKota');
    Route::get('services/get-kecamatan/{kabupatenkota_id}',[ServicesController::class,'getKecamatan'])->name('services.getKecamatan');
    Route::get('services/get-kelurahan/{kabupatenkota_id}/{kecamatan_id?}',[ServicesController::class,'getKelurahan'])->name('services.getKelurahan');
    Route::get('psu-perumahan/get-psu-perumahan/{PsuPerumahan?}',[PsuPerumahanController::class,'getPsuItem'])->name('psuperumahan.getPsuItem');
    Route::patch('psu-perumahan/update-psu-perumahan/{PsuPerumahan?}',[PsuPerumahanController::class,'updatePsuItem'])->name('psuperumahan.updatePsuItem');
    Route::get('psu-perumahan/get-attribute-psu/{PsuPerumahan?}/{PSU?}',[PsuPerumahanController::class,'getPsuAttributeForm'])->name('psuperumahan.getPsuAttributeForm');
    Route::post('psu-perumahan/post-perumahan/{perumahan}',[PsuPerumahanController::class,'storeFromPerumahan'])->name('psuperumahan.storeFromPerumahan');
    Route::patch('psu-perumahan/patch-perumahan/{perumahan}/edit',[PsuPerumahanController::class,'updateFromPerumahan'])->name('psuperumahan.updateFromPerumahan');
    Route::delete('psu-perumahan/delete-perumahan/{perumahan}/delete',[PsuPerumahanController::class,'destroyFromPerumahan'])->name('psuperumahan.destroyFromPerumahan');
})->middleware('auth');

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
