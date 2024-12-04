<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KetuaProgramStudiController;
use App\Http\Controllers\BagianAkademikController;
use App\Http\Controllers\DekanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenPengampuController;
use App\Http\Controllers\PembimbingAkademikController;
use App\Http\Controllers\IRSController;
use App\Models\Ketuaprogramstudi;
use App\Models\Mahasiswa;

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

// Route::get('mahasiswa', function () {
//     return view('mahasiswa.dashboard', ['title' => 'Mahasiswa']);
// })->name('mahasiswa');

// Route::get('ketuaprogramstudi', function () {
//     return view('ketuaprogramstudi.dashboard', ['title' => 'ketuaprogramstudi']);
// })->name('ketuaprogramstudi');

// Route::get('dekan', function () {
//     return view('dekan.dashboard', ['title' => 'dekan']);
// })->name('dekan');

// Route::get('dosenpengampu', function () {
//     return view('dosenpengampu.dashboard', ['title' => 'dosenpengampu']);
// })->name('dosenpengampu');

// Route::get('bagianakademik', function () {
//     return view('bagianakademik.dashboard', ['title' => 'bagianakademik']);
// })->name('bagianakademik');

// Route::get('pembimbingakademik', function () {
//     return view('pembimbingakademik.dashboard', ['title' => 'pembimbingakademik']);
// })->name('pembimbingakademik');

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
// Route::get('/bagianakademik/dashboard', [BagianAkademikController::class, 'dashboard'])->name('bagianakademik');
// Route::get('/dekan/dashboard', [DekanController::class, 'dashboard'])->name('dekan');
// Route::get('/ketuaprogramstudi/dashboard', [KetuaProgramStudiController::class, 'dashboard'])->name('ketuaprogramstudi');
// Route::get('/pembimbingakademik/dashboard', [PembimbingAkademikController::class, 'dashboard'])->name('pembimbingakademik');
// Route::get('/dosenpengampu/dashboard', [DosenPengampuController::class, 'dashboard'])->name('dosenpengampu');
// Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/bagianakademik', [UserController::class, 'dashboard'])->name('bagianakademik');
    Route::get('/dashboard/dekan', [UserController::class, 'dashboard'])->name('dekan');
    Route::get('/dashboard/ketuaprogramstudi', [UserController::class, 'dashboard'])->name('ketuaprogramstudi');
    Route::get('/dashboard/pembimbingakademik', [UserController::class, 'dashboard'])->name('pembimbingakademik');
    Route::get('/dashboard/dosenpengampu', [UserController::class, 'dashboard'])->name('dosenpengampu');
    Route::get('/dashboard/mahasiswa', [UserController::class, 'dashboard'])->name('mahasiswa');
});

// Route::get('dashboard/{role}', [UserController::class, 'index'])->name('dashboard');

// bagian akademik penyusunan ruang
Route::get('bagianakademik/penyusunanruang/create', [BagianAkademikController::class, 'createPenyusunanRuang'])->name('penyusunanruang.create');
Route::post('penyusunanruang', [BagianAkademikController::class, 'storePenyusunanRuang'])->name('penyusunanruang.store');
Route::get('penyusunanruang/index', [BagianAkademikController::class, 'indexPenyusunanRuang'])->name('penyusunanruang.index');
Route::get('penyusunanruang/{kode_ruang}/edit', [BagianAkademikController::class, 'editPenyusunanRuang'])->name('penyusunanruang.edit');
Route::put('penyusunanruang/{kode_ruang}', [BagianAkademikController::class, 'updatePenyusunanRuang'])->name('penyusunanruang.update');
Route::delete('penyusunanruang/{kode_ruang}', [BagianAkademikController::class, 'destroyPenyusunanRuang'])->name('penyusunanruang.destroy');

// bagian akademik pengalokasian ruang
Route::get('bagianakademik/pengalokasianruang/create', [BagianAkademikController::class, 'createPengalokasianRuang'])->name('pengalokasianruang.create');
Route::post('pengalokasianruang', [BagianAkademikController::class, 'storePengalokasianRuang'])->name('pengalokasianruang.store');
Route::get('bagianakademik/pengalokasianruang/index', [BagianAkademikController::class, 'indexPengalokasianRuang'])->name('pengalokasianruang.index');
Route::delete('pengalokasianruang/{kode_ruang}', [BagianAkademikController::class, 'destroyAlokasiRuang'])->name('pengalokasianruang.destroy');

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
Route::delete('/jadwal-kuliah/{id_jadwal}', [KetuaProgramStudiController::class, 'destroyJadwalKuliah'])->name('jadwalkuliah.destroy');
Route::get('Ketuaprogramstudi/jadwalkuliah/lihatjadwalkuliah', [KetuaProgramStudiController::class, 'indexjadwalKuliah'])->name('lihatjadwalkuliah.lihat');
Route::post('/hitung-jam-selesai', [KetuaProgramStudiController::class, 'hitungJamSelesai'])->name('jadwalkuliah.hitungJamSelesai');
Route::get('/getRuangan/{id_programstudi}', [KetuaProgramStudiController::class, 'getRuangan']);
Route::get('/getMatakuliah/{id_programstudi}', [KetuaProgramStudiController::class, 'getMatakuliah']);
Route::get('/get-dosen/{kode_mk}', [KetuaprogramstudiController::class, 'getDosenByMk']);

// dekan menyetujui ruangan
Route::get('/dekan/approve-ruang', [DekanController::class, 'indexPengajuanRuang'])->name('dekan.approveruang');
Route::patch('/pengajuan/update/{id}', [DekanController::class, 'updatePengajuanRuang'])->name('pengajuan.updateruang');

//dekan menyetujui jadwal
Route::get('/dekan/approve-jadwal', [DekanController::class, 'indexPengajuanJadwal'])->name('dekan.approvejadwal');
Route::patch('/dekan/update-pengajuan/{id}', [DekanController::class, 'updatePengajuanJadwal'])->name('pengajuan.updatejadwal');

// IRS
Route::get('memilihmatakuliah/IRS', [MahasiswaController::class, 'createIRS'])->name('irs.create');
Route::get('/search-matakuliah', [MahasiswaController::class, 'searchMatakuliah'])->name('search.Mahasiswa');

Route::get('/get-matkul-details', [MahasiswaController::class, 'getMatkulDetails'])->name('get.matkul.details');
Route::post('/irs/store', [MahasiswaController::class, 'store'])->name('irs.store');
Route::get('/Lihat/IRS', [MahasiswaController::class, 'index'])->name('irs.index');

Route::get('verifikasiirs', function () {
    return view('pembimbingakademik.verifikasiirs', ['title' => 'verfikasiirs']);
})->name('verifikasiirs');
Route::get('lihatirs', function () {
    return view('pembimbingakademik.lihatirs', ['title' => 'lihatirs']);
})->name('lihatirs');

Route::post('/irs/delete', [MahasiswaController::class, 'delete'])->name('irs.delete');

// Route::post('/irs/delete', [MahasiswaController::class, 'destroy'])->name('irs.destroy');
Route::get('/masuk/IRS', [PembimbingAkademikController::class, 'approveIRS'])->name('pembimbingakademik.verifikasiirs');
Route::get('/masuk/IRS/verifikasi/{nim}', [PembimbingAkademikController::class, 'approveIRS2'])->name('pembimbingakademik.lihatverifikasi');
Route::post('/pembimbing-akademik/persetujuan-irs', [PembimbingAkademikController::class, 'persetujuanIRS'])->name('pembimbingakademik.persetujuanirs');

Route::get('/check-irs-status', [MahasiswaController::class, 'checkStatus'])->name('check.irs.status');
// profile
// Route::get('profile', function () {
//     return view('mahasiswa.profile', ['title' => 'profile']);
// })->name('mahasiswa.profile');

Route::get('/dashboard/profile/mahasiswa', [MahasiswaController::class, 'profile'])->name('mahasiswa.profile');

