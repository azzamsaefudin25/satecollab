<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KetuaProgramStudiController;
use App\Http\Controllers\BagianAkademikController;
use App\Http\Controllers\DekanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\IRSController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('user.login', ['title' => 'Login']);
})->name('login');

// login
// Route::get('register', [UserController::class, 'register'])->name('register');
// Route::post('register', [UserController::class, 'register_action'])->name('register.action');
// Route::get('password', [UserController::class, 'password'])->name('password');
// Route::post('password', [UserController::class, 'password_action'])->name('password.action');
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'login_action'])->name('login.action');
Route::get('logout', [UserController::class, 'logout'])->name('logout');

// pemilihan role
Route::post('pemilihanrole', [UserController::class, 'handleRoleSelection'])->name('handleRoleSelection');

// input dashboard
Route::get('dashboard/bagianakademik', [UserController::class, 'index'])->name('bagianakademik');
Route::get('dashboard/dekan', [UserController::class, 'index'])->name('dekan');
Route::get('dashboard/ketuaprogramstudi', [UserController::class, 'index'])->name('ketuaprogramstudi');
Route::get('dashboard/pembimbingakademik', [UserController::class, 'index'])->name('pembimbingakademik');
Route::get('dashboard/mahasiswa', [UserController::class, 'index'])->name('mahasiswa');
Route::get('dashboard/dosenpengampu', [UserController::class, 'index'])->name('dosenpengampu');

// Route::get('dashboard/mahasiswa', [UserController::class, 'index'])
//     ->name('mahasiswa')
//     ->middleware('role:mahasiswa');
// Route::get('dashboard/bagianakademik', [UserController::class, 'index'])
//     ->name('bagianakademik')
//     ->middleware('role:bagianakademik');
// Route::get('dashboard/dekan', [UserController::class, 'index'])
//     ->name('dekan')
//     ->middleware('role:dekan');
// Route::get('dashboard/ketuaprogramstudi', [UserController::class, 'index'])
//     ->name('ketuaprogramstudi')
//     ->middleware('role:ketuaprogramstudi');
// Route::get('dashboard/pembimbingakademik', [UserController::class, 'index'])
//     ->name('pembimbingakademik')
//     ->middleware('role:pembimbingakademik');
// Route::get('dashboard/dosenpengampu', [UserController::class, 'index'])
//     ->name('dosenpengampu')
//     ->middleware('role:dosenpengampu');
// Route::get('dashboard/{role}', [UserController::class, 'index'])
//     ->name('dashboard')
//     ->middleware('RoleMiddleware');

Route::get('dashboard/{role}', [UserController::class, 'index'])->name('dashboard');

// bagian akademik penyusunan ruang
Route::get('bagianakademik/penyusunanruang', [BagianAkademikController::class, 'createPenyusunanRuang'])->name('penyusunanruang.create');
Route::post('penyusunanruang', [BagianAkademikController::class, 'storePenyusunanRuang'])->name('penyusunanruang.store');
Route::get('penyusunanruang/index', [BagianAkademikController::class, 'indexPenyusunanRuang'])->name('penyusunanruang.index');
Route::get('penyusunanruang/{kode_ruang}/edit', [BagianAkademikController::class, 'editPenyusunanRuang'])->name('penyusunanruang.edit');
Route::put('penyusunanruang/{kode_ruang}', [BagianAkademikController::class, 'updatePenyusunanRuang'])->name('penyusunanruang.update');
Route::delete('penyusunanruang/{kode_ruang}', [BagianAkademikController::class, 'destroyPenyusunanRuang'])->name('penyusunanruang.destroy');

// bagian akademik pengalokasian ruang
Route::get('bagianakademik/pengalokasianruang', [BagianAkademikController::class, 'createPengalokasianRuang'])->name('pengalokasianruang.create');
Route::post('pengalokasianruang', [BagianAkademikController::class, 'storePengalokasianRuang'])->name('pengalokasianruang.store');
Route::get('bagianakademik/pengalokasianruang/lihat', [BagianAkademikController::class, 'indexPengalokasianRuang'])->name('pengalokasianruang.lihat');

//kaprodi menyusun matakuliah
Route::get('memilihmatakuliah/create', [KetuaProgramStudiController::class, 'createMemilihMataKuliah'])->name('memilihmatakuliah.create');
Route::post('memilihmatakuliah', [KetuaProgramStudiController::class, 'storeMemilihMataKuliah'])->name('memilihmatakuliah.store');
Route::get('/memilihmatakuliah', [KetuaProgramStudiController::class, 'indexMemilihMataKuliah'])->name('memilihmatakuliah.index');
Route::get('memilihmatakuliah/{kode_mk}/edit', [KetuaProgramStudiController::class, 'editMemilihMataKuliah'])->name('memilihmatakuliah.edit');
Route::put('memilihmatakuliah/{kode_mk}', [KetuaProgramStudiController::class, 'updateMemilihMataKuliah'])->name('memilihmatakuliah.update');
Route::delete('memilihmatakuliah/{kode_mk}', [KetuaProgramStudiController::class, 'destroyMemilihMataKuliah'])->name('memilihmatakuliah.destroy');

//kaprodi jadwal kuliah
Route::get('JadwalKuliah', [KetuaProgramStudiController::class, 'createJadwalKuliah'])->name('jadwalkuliah.create');
Route::post('JadwalKuliah', [KetuaProgramStudiController::class, 'storeJadwalKuliah'])->name('jadwalkuliah.store');
Route::get('Ketuaprogramstudi/jadwalkuliah/lihatjadwalkuliah', [KetuaProgramStudiController::class, 'indexjadwalKuliah'])->name('lihatjadwalkuliah.lihat');
Route::post('/hitung-jam-selesai', [KetuaProgramStudiController::class, 'hitungJamSelesai'])->name('jadwalkuliah.hitungJamSelesai');
Route::get('/getRuangan/{id_programstudi}', [KetuaProgramStudiController::class, 'getRuangan']);

// dekan menyetujui ruangan
Route::get('/dekan/approve-ruang', [DekanController::class, 'createPengajuanRuang'])->name('dekan.approveruang');
Route::patch('/pengajuan/update/{id}', [DekanController::class, 'updatePengajuanRuang'])->name('pengajuan.updateruang');

//dekan menyetujui jadwal
Route::get('/dekan/approve-jadwal', [DekanController::class, 'createPengajuanJadwal'])->name('dekan.approvejadwal');
Route::patch('/dekan/update-pengajuan/{id}', [DekanController::class, 'updatePengajuanJadwal'])->name('pengajuan.updatejadwal');

// IRS
Route::get('memilihmatakuliah/IRS', [MahasiswaController::class, 'createIRS'])->name('IRS.create');
Route::get('/search-matakuliah', [MahasiswaController::class, 'searchMatakuliah'])->name('search.Mahasiswa');

Route::get('/get-matkul-details', [MahasiswaController::class, 'getMatkulDetails'])->name('get.matkul.details');
Route::post('/irs/store', [IRSController::class, 'store'])->name('irs.store');
Route::get('/Lihat/IRS', [IRSController::class, 'index'])->name('IRS.index');
