<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();
Route::get('login','LoginController@login')->name('login');
Route::get('register','LoginController@register')->name('register');
Route::post('postLogin','LoginController@postLogin');
Route::post('postRegister','LoginController@postRegister');

Route::group(['middleware'=>'auth',],function(){

Route::get('admin/logout','LoginController@logout');
Route::get('guru/logout','LoginController@logout');
Route::get('siswa/logout','LoginController@logout');

//guru profil
Route::get('guru','GuruController@dashboardGuru');
Route::get('guru/profil','GuruController@profilGuru');
Route::post('editProfilGuru','GuruController@editProfilGuru');
Route::post('editFotoGuru','GuruController@editFotoGuru');
Route::post('editPasswordGuru','GuruController@editPasswordGuru');
//guru Materi
Route::get('guru/materi','GuruController@daftarMapelMateri');
Route::get('guru/materi/daftar-materi/{id}','GuruController@daftarMateri');
// Route::get('guru/semua-materi','GuruController@')
Route::get('guru/materi/tambah-materi/{id}','GuruController@tambahMateri')->name('guru.tambahMateri');
Route::post('guru/materi/addMateri','GuruController@addMateri');
Route::get('guru/ubah-materi/{id}','GuruController@ubahMateri');
Route::post('guru/changeMateri','GuruController@changeMateri');
Route::get('guru/hapusMateri','GuruController@hapusMateri');
Route::get('guru/materi/download-materi/{id}','GuruController@downloadMateri');

//guru nilai
Route::get('guru/daftar-nilai','GuruController@nilaiSiswa')->name('guru.daftarNilai');
Route::get('guru/input-nilai','GuruController@inputNilai')->name('guru.inputNilai');
Route::post('guru/postDaftarNilai','GuruController@postDaftarNilai')->name('postDaftarNilai');
Route::get('guru/tambah-nilai/{id}','GuruController@tambahNilai');
Route::get('guru/detail-nilai/{id}','GuruController@detailNilai')->name('detailNilai');
Route::post('guru/addNilai','GuruController@addNilai');
Route::post('guru/detail-nilai/{id},','GuruController@detailNilai');
Route::get('guru/ubah-nilai/{id}','GuruController@ubahNilai');
Route::post('guru/detail-nilai/postChangeNilai/{id}','GuruController@postChangeNilai');
Route::get('guru/import-nilai/{id}','GuruController@importNilai');
Route::get('guru/download-nilai/{id}/{type}','GuruController@downloadNilaiExcel');
Route::get('guru/download-nilai-pdf/{id}','GuruController@downloadNilaiPDF');
//guru rekap
Route::get('guru/rekap-rapor','GuruController@rekapRapor')->name('guru.rekapRapor');
Route::get('guru/download','GuruController@download');
Route::get('guru/rekap-laporan','GuruController@rekapLaporan');

// });

// Route::group(['middleware'=>'level:admin'], function(){
//admin Nilai

Route::get('admin/daftar-nilai','AdminController@nilaiSiswa')->name('admin.daftarNilai');
Route::get('admin/input-nilai','AdminController@inputNilai')->name('admin.inputNilai');
Route::post('admin/postDaftarNilai','AdminController@postDaftarNilai')->name('admin.postDaftarNilai');
Route::get('admin/tambah-nilai/{id}','AdminController@tambahNilai');
Route::get('admin/detail-nilai/{id}','AdminController@detailNilai')->name('detailNilai');
Route::post('admin/addNilai','AdminController@addNilai');
Route::post('admin/detail-nilai/{id},','AdminController@detailNilai');
Route::get('admin/ubah-nilai/{id}','AdminController@ubahNilai');
Route::post('admin/detail-nilai/postChangeNilai/{id}','AdminController@postChangeNilai');
Route::get('admin/import-nilai/{id}','AdminController@importNilai');
Route::get('admin/download-nilai/{id}/{type}','AdminController@downloadNilaiExcel');
Route::get('admin/download-nilai-pdf/{id}','AdminController@downloadNilaiPDF');
//admin rekap
Route::get('guru/rekap-rapor','GuruController@rekapRapor')->name('guru.rekapRapor');
Route::get('admin/download','AdminController@download');
Route::get('admin/rekap-laporan','AdminController@rekapLaporan');

//Kepsek
Route::get('kepsek','GuruController@dashboardKepsek');
//Admin data guru
Route::get('admin','AdminController@dashboardAdmin');
Route::get('admin/daftar-guru','AdminController@daftarGuru')->name('admin.daftarGuru');

Route::get('admin/tambah-guru','AdminController@tambahGuru')->name('tambahGuru');
Route::get('admin/detail-guru/{id}','AdminController@detailGuru');
Route::post('admin/addGuru','AdminController@addGuru')->name('addGuru');
Route::get('admin/ubah-Guru','AdminController@ubahGuru')->name('ubahGuru');
Route::post('admin/changeGuru','AdminController@changeGuru');
Route::post('admin/addJadwal','AdminController@addJadwal');
Route::post('admin/changeJadwal','AdminController@changeJadwal');
Route::get('admin/hapus-jadwal','AdminController@hapusJadwal');

// admin data Siswa
Route::get('admin/daftar-siswa','AdminController@daftarSiswa')->name('admin.daftarSiswa');
Route::get('admin/detail-siswa/{id}','AdminController@detailSiswa');
Route::get('admin/tambah-siswa','AdminController@tambahSiswa')->name('tambahSiswa');
Route::post('admin/addSiswa','AdminController@addSiswa')->name('addSiswa');
Route::get('admin/ubah-Siswa','AdminController@ubahSiswa')->name('ubahSiswa');
Route::post('admin/changeSiswa','AdminController@changeSiswa');
Route::post('admin/changeParentSiswa','AdminContr oller@changeParentSiswa');
Route::post('admin/changePassSiswa','AdminController@changePassSiswa');
// admin Mapel
Route::get('admin/daftar-mapel','AdminController@daftarMapel')->name('admin.daftarMapel');
Route::get('admin/tambah-mapel','AdminController@tambahMapel')->name('tambahMapel');
Route::get('admin/detail-mapel/{id}','AdminController@detailMapel');
Route::post('admin/addMapel','AdminController@addMapel')->name('addMapel');
Route::get('admin/ubah-Mapel','AdminController@ubahMapel')->name('ubahMapel');
Route::post('admin/changeMapel','AdminController@changeMapel');
// admin Kelas
Route::get('admin/daftar-kelas','AdminController@daftarKelas')->name('admin.daftarKelas');
Route::get('admin/tambah-kelas','AdminController@tambahKelas')->name('tambahKelas');
Route::get('admin/detail-kelas/{id}','AdminController@detailKelas');
Route::post('admin/addKelas','AdminController@addKelas')->name('addKelas');
Route::get('admin/ubah-Kelas','AdminController@ubahKelas')->name('ubahKelas');
Route::post('admin/changeKelas','AdminController@changeKelas');
//admin materi
Route::get('admin/materi','AdminController@daftarMapelMateri');
Route::get('admin/materi/daftar-materi/{id}','AdminController@daftarMateri');
// <!--Route::get('admin/semua-materi','AdminController@') -->
Route::get('admin/materi/tambah-materi/{id}','AdminController@tambahMateri')->name('guru.tambahMateri');
Route::post('admin/materi/addMateri','AdminController@addMateri');
Route::get('admin/ubah-materi/{id}','AdminController@ubahMateri');
Route::post('admin/changeMateri','AdminController@changeMateri');
Route::get('admin/hapus-materi/{id}','AdminController@hapusMateri');
Route::get('admin/materi/download-materi/{id}','AdminController@downloadMateri');
//admin user
Route::get('admin/daftar-pengguna','AdminController@daftarPengguna')->name('daftarPengguna');
Route::get('admin/tambah-pengguna','AdminController@tambahPengguna')->name('tambahPengguna');
Route::post('admin/addPengguna','AdminController@addPengguna')->name('addPengguna');
Route::get('admin/ubah-pengguna/{id}','AdminController@ubahPengguna')->name('ubahPengguna');
Route::post('admin/changeProfil','AdminController@changeProfil');
Route::get('admin/profil','AdminController@adminProfil')->name('adminProfil');
//profil admin
Route::post('admin/ubahProfil','AdminController@ubahProfil');
Route::post('admin/changePasswordAdmin','AdminController@changePasswordAdmin');
});


Route::get('/home', 'HomeController@index')->name('home');
