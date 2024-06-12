<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\HalamanController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\PerumahanController;
use App\Http\Controllers\Admin\PermukimanController;
use App\Http\Controllers\Admin\PsuPerkiController;
use App\Http\Controllers\Admin\PengajuanController;
use App\Http\Controllers\Admin\MonitoringController;
use App\Http\Controllers\Admin\KabupatenKotaController;
use App\Http\Controllers\Admin\KecamatanController;
use App\Http\Controllers\Admin\KelurahanController;
use App\Http\Controllers\Admin\KategoriPsuController;
use App\Http\Controllers\Admin\JenisPsuController;
use App\Http\Controllers\Admin\PsuPerumahanController;
use App\Http\Controllers\Admin\PsuPermukimanController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\UbahPasswordController;
use App\Http\Controllers\Front\FrontPermukimanController;
use App\Http\Controllers\Front\FrontPerumahanController;
use App\Http\Controllers\Front\FrontPsuController;

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
    Route::resource('permukiman',PermukimanController::class);
    Route::get('permukiman/{permukiman}/document',[PermukimanController::class,'document'])->name('permukiman.document');
    Route::get('permukiman/{permukiman}/peta',[PermukimanController::class,'peta'])->name('permukiman.peta');
    Route::get('permukiman/{permukiman}/psu',[PermukimanController::class,'psu'])->name('permukiman.psu');
    Route::get('permukiman/{permukiman}/print',[PermukimanController::class,'print'])->name('permukiman.print');
    Route::get('permukiman/{permukiman}/pdf',[PermukimanController::class,'pdf'])->name('permukiman.pdf');
    Route::get('permukiman/{permukiman}/psu-detail',[PermukimanController::class,'psuDetail'])->name('permukiman.psuDetail');
    Route::get('permukiman/{permukiman}/form-upload-peta',[PermukimanController::class,'formUploadPeta'])->name('permukiman.formUploadPeta');
    Route::get('permukiman/{permukiman}/form-upload-dokumen',[PermukimanController::class,'formUploadDokumen'])->name('permukiman.formUploadDokumen');
    Route::post('permukiman/{permukiman}/upload-peta',[PermukimanController::class,'uploadPeta'])->name('permukiman.uploadPeta');
    Route::post('permukiman/{permukiman}/upload-dokumen',[PermukimanController::class,'uploadDokumen'])->name('permukiman.uploadDokumen');
    Route::post('permukiman/{permukiman}/generate-geojson',[PermukimanController::class,'generateShp'])->name('permukiman.generateShp');
    Route::post('permukiman/{permukiman}/save-geojson',[PermukimanController::class,'saveGeojson'])->name('permukiman.saveGeojson');
    Route::resource('psu',PsuPerkiController::class);
    Route::resource('psuperki',PsuPerkiController::class);
    Route::get('psuperki/{psuperki}/document',[PsuPerkiController::class,'document'])->name('psuperki.document');
    Route::get('psuperki/{psuperki}/peta',[PsuPerkiController::class,'peta'])->name('psuperki.peta');
    Route::get('psuperki/{psuperki}/psu',[PsuPerkiController::class,'psu'])->name('psuperki.psu');
    Route::get('psuperki/{psuperki}/print',[PsuPerkiController::class,'print'])->name('psuperki.print');
    Route::get('psuperki/{psuperki}/pdf',[PsuPerkiController::class,'pdf'])->name('psuperki.pdf');
    Route::get('psuperki/{psuperki}/psu-detail',[PsuPerkiController::class,'psuDetail'])->name('psuperki.psuDetail');
    Route::get('psuperki/{psuperki}/form-upload-peta',[PsuPerkiController::class,'formUploadPeta'])->name('psuperki.formUploadPeta');
    Route::get('psuperki/{psuperki}/form-upload-dokumen',[PsuPerkiController::class,'formUploadDokumen'])->name('psuperki.formUploadDokumen');
    Route::post('permukiman/{permukiman}/upload-peta',[PermukimanController::class,'uploadPeta'])->name('permukiman.uploadPeta');
    Route::post('permukiman/{permukiman}/upload-dokumen',[PermukimanController::class,'uploadDokumen'])->name('permukiman.uploadDokumen');
    Route::post('permukiman/{permukiman}/generate-geojson',[PermukimanController::class,'generateShp'])->name('permukiman.generateShp');
    Route::post('permukiman/{permukiman}/save-geojson',[PermukimanController::class,'saveGeojson'])->name('permukiman.saveGeojson');
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
    Route::get('psu-perumahan/get-psu-perumahan/{PsuPermukiman?}',[PsuPerumahanController::class,'getPsuItem'])->name('psuperumahan.getPsuItem');
    Route::patch('psu-perumahan/update-psu-perumahan/{PsuPermukiman?}',[PsuPerumahanController::class,'updatePsuItem'])->name('psuperumahan.updatePsuItem');
    Route::get('psu-perumahan/get-attribute-psu/{PsuPermukiman?}/{PSU?}',[PsuPerumahanController::class,'getPsuAttributeForm'])->name('psuperumahan.getPsuAttributeForm');
    Route::post('psu-perumahan/post-perumahan/{perumahan}',[PsuPerumahanController::class,'storeFromPerumahan'])->name('psuperumahan.storeFromPerumahan');
    Route::patch('psu-perumahan/patch-perumahan/{perumahan}/edit',[PsuPerumahanController::class,'updateFromPermukiman'])->name('psuperumahan.updateFromPermukiman');
    Route::delete('psu-perumahan/delete-perumahan/{perumahan}/delete',[PsuPerumahanController::class,'destroyFromPermukiman'])->name('psuperumahan.destroyFromPermukiman');

    
    Route::get('psu-permukiman/get-psu-permukiman/{PsuPermukiman?}',[PsuPermukimanController::class,'getPsuItem'])->name('psupermukiman.getPsuItem');
    Route::patch('psu-permukiman/update-psu-permukiman/{PsuPermukiman?}',[PsuPermukimanController::class,'updatePsuItem'])->name('psupermukiman.updatePsuItem');
    Route::get('psu-permukiman/get-attribute-psu/{PsuPermukiman?}/{PSU?}',[PsuPermukimanController::class,'getPsuAttributeForm'])->name('psupermukiman.getPsuAttributeForm');
    Route::post('psu-permukiman/post-permukiman/{permukiman}',[PsuPermukimanController::class,'storeFromPermukiman'])->name('psupermukiman.storeFromPermukiman');
    Route::patch('psu-permukiman/patch-permukiman/{permukiman}/edit',[PsuPermukimanController::class,'updateFromPermukiman'])->name('psupermukiman.updateFromPermukiman');
    Route::delete('psu-permukiman/delete-permukiman/{permukiman}/delete',[PsuPermukimanController::class,'destroyFromPermukiman'])->name('psupermukiman.destroyFromPermukiman');
    
    
    Route::get('psu-perki/get-psu-perki/{PsuPerki?}',[PsuPerkiController::class,'getPsuItem'])->name('psuperki.getPsuItem');
    Route::patch('psu-perki/update-psu-perki/{PsuPerki?}',[PsuPerkiController::class,'updatePsuItem'])->name('psuperki.updatePsuItem');
    Route::get('psu-perki/get-attribute-psu/{PsuPerki?}/{PSU?}',[PsuPerkiController::class,'getPsuAttributeForm'])->name('psuperki.getPsuAttributeForm');
    Route::post('psu-perki/post-perki/{perki}',[PsuPerkiController::class,'storeFromPerki'])->name('psuperki.storeFromPerki');
    Route::patch('psu-perki/patch-perki/{perki}/edit',[PsuPerkiController::class,'updateFromPerki'])->name('psuperki.updateFromPerki');
    Route::delete('psu-perki/delete-perki/{perki}/delete',[PsuPerkiController::class,'destroyFromPerki'])->name('psuperki.destroyFromPerki');


    Route::get('import-perumahans', [PerumahanController::class, 'formImport'])->name('perumahan.import');
    Route::post('import-perumahans', [PerumahanController::class, 'storeImport'])->name('perumahan.import');
    Route::get('import-permukimans', [PermukimanController::class, 'formImport'])->name('permukiman.import');
    Route::post('import-permukimans', [PermukimanController::class, 'storeImport'])->name('permukiman.import');
})->middleware('auth');

Route::name('front.')->group(function(){
        
    Route::get('permukiman', [FrontPermukimanController::class,'index'])->name('permukiman');
    Route::get('permukiman/peta/{permukiman}', [FrontPermukimanController::class,'index'])->name('permukiman.peta');
    Route::get('permukiman/print/{permukiman}', [FrontPermukimanController::class,'index'])->name('permukiman.print');
    Route::get('permukiman/detail/{permukiman}', [FrontPermukimanController::class,'index'])->name('permukiman.detail');
    Route::get('permukiman/pdf/{permukiman}', [FrontPermukimanController::class,'index'])->name('permukiman.pdf');
    Route::get('perumahan', [FrontPerumahanController::class,'index'])->name('perumahan');
    Route::get('perumahan/peta/{perumahan}', [FrontPerumahanController::class,'index'])->name('perumahan.peta');
    Route::get('perumahan/print/{perumahan}', [FrontPerumahanController::class,'index'])->name('perumahan.print');
    Route::get('perumahan/detail/{perumahan}', [FrontPerumahanController::class,'index'])->name('perumahan.detail');
    Route::get('perumahan/pdf/{perumahan}', [FrontPerumahanController::class,'index'])->name('perumahan.pdf');
    Route::get('psu', [FrontPsuController::class,'index'])->name('psu');
    Route::get('psu/peta/{psu}', [FrontPsuController::class,'index'])->name('psu.peta');
    Route::get('psu/print/{psu}', [FrontPsuController::class,'index'])->name('psu.print');
    Route::get('psu/detail/{psu}', [FrontPsuController::class,'index'])->name('psu.detail');
    Route::get('psu/pdf/{psu}', [FrontPsuController::class,'index'])->name('psu.pdf');
                
    Route::get('peta', function() {
        return view('front.layouts.peta');
    })->name('peta');
        
    Route::get('statistik', function() {
        return view('front.layouts.statistik');
    })->name('statistik');
        
    Route::get('page', function() {
        return view('front.layouts.page');
    })->name('page');

});

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
