<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Guru;
use App\Siswa;
use App\Kelas;
use App\Mapel;
use App\Nilai;
use App\Materi;
use Redirect;
use Auth;

class AdminController extends Controller
{

	function dashboardAdmin(Request $Request)
	{
		$mapel = DB::table('mapel')->get();
		$kelas = DB::table('kelas')->get();
		$siswa = DB::table('siswa')->get();
		$guru = DB::table('guru')->get();		

		return view('admin.dashboard',compact('siswa','guru','kelas','mapel'));
	}

	function daftarPengguna(Request $request)
	{
		$mapel = DB::table('mapel')->count();
		$kelas = DB::table('kelas')->count();
		$siswa = DB::table('siswa')->count();
		$guru = DB::table('guru')->count();		
		$pengguna = DB::table('users')->get();
		return view('admin.daftar-pengguna',compact('mapel','kelas','siswa','guru','pengguna'));
	}

	function daftarGuru(Request $request)
	{
		$guru = DB::table('guru')->get();
		$siswa = DB::table('siswa')->count();
		$kelas = DB::table('kelas')->get();
		$mapel = DB::table('mapel')->get();
		return view('admin.daftar-guru',compact('guru','siswa','kelas','mapel'));
	}

	function detailGuru(Request $request,$id)
	{
		$guru = Guru::find($id);
		$mapel = DB::table('mapel')->get();
		$kelas = DB::table('kelas')->get();
		$jadwal = DB::table('jadwal_mengajar')->select('jadwal_mengajar.id','mapel.nama_mapel','kelas.kode_kelas','jadwal_mengajar.jam_awal','jadwal_mengajar.jam_akhir')
				  ->join('kelas','jadwal_mengajar.id_kelas','=','kelas.id')
				  ->join('mapel','jadwal_mengajar.id_mapel','=','mapel.id')
				  ->where('jadwal_mengajar.id_guru','=',$id)->get();
		return view('admin.detail-guru',compact('guru','kelas','mapel','jadwal'));		
	}

	function tambahGuru(Request $request)
	{
		return view('admin.tambah-guru');
	}

	function addGuru(Request $request)
	{
		if($request->hasFile('foto')){
		$foto = $request->file('foto');
    	$namaFoto = $foto->getClientOriginalName();
    	$request->file('foto')->move("storage/guru",$namaFoto);
		}else{
			$namaFoto = NULL;
		}
		$guru = new Guru();
		$guru->nip = $request->nip;
		$guru->nama = $request->nama;
		$guru->jk = $request->jk;
		$guru->status = $request->status;
		$guru->tempat_lahir = $request->tempat_lahir;
		$guru->tgl_lahir = date('Y-m-d',strtotime($request->tgl_lahir));
		$guru->tgl_masuk = date('Y-m-d',strtotime($request->tgl_masuk));
		$guru->url_photo = $namaFoto;
		$guru->agama = $request->agama;
		$guru->status = 'aktif';
		$guru->gol = 'unknown';
		$guru->alamat = $request->alamat;
		$guru->no_telp = $request->no_telp;
		$guru->save();
		return redirect('admin/daftar-guru')->with('message','Berhasil menambah data guru!');
	}

	function ubahGuru(Request $request,$id)
	{
		$user = User::find($id);
		return view('admin.ubah-guru',compact('user'));
	}

	function changeGuru(Request $request)
	{
		$guru = Guru::find($request->id);
		$guru->nip = $request->nip;
		$guru->nama = $request->nama;
		$guru->jk = $request->jk;
		$guru->status = $request->status;
		$guru->tempat_lahir = $request->tempat_lahir;
		$guru->tgl_lahir = date('Y-m-d',strtotime($request->tgl_lahir));
		$guru->tgl_masuk = date('Y-m-d',strtotime($request->tgl_masuk));
		$guru->agama = $request->agama;
		$guru->alamat = $request->alamat;
		$guru->no_telp = $request->no_telp;
		$guru->update();
		return redirect('admin/daftar-guru')->with('message','Berhasil mengubah data guru!');
	}

	function addJadwal(Request $request)
	{
		$jadwal = array('id_guru'=>$request->id_guru,
						'id_mapel'=>$request->id_mapel,
						'id_kelas'=>$request->id_kelas,
						'jam_awal'=>date("H:i",strtotime($request->jam_awal)),
						'jam_akhir'=>date("H:i
							",strtotime($request->jam_akhir)));

		DB::table('jadwal_mengajar')->insert($jadwal);
		return redirect('admin/daftar-guru')->with('message','Berhasil menambah data jadwal mengajar!');
	}
	function changeJadwal(Request $request)
	{
		$jadwal = array('id_guru'=>$request->id_guru,
						'id_mapel'=>$request->id_mapel,
						'id_kelas'=>$request->id_kelas,
						'jam_awal'=>date("H:i",strtotime($request->jam_awal)),
						'jam_akhir'=>date("H:i
							",strtotime($request->jam_akhir)));

		DB::table('jadwal_mengajar')->insert($jadwal);
		return redirect('admin/daftar-guru')->with('message','Berhasil menambah data jadwal mengajar!');
	}

	function daftarUser(Request $request)
	{
		$guru = DB::table('guru')->get();
		$siswa = DB::table('siswa')->count();
		$kelas = DB::table('kelas')->get();
		$mapel = DB::table('mapel')->get();
		$user = DB::table('users')->get();
		return view('admin.users',compact('user','siswa','kelas','mapel','user'));
	}

	function tambahUser(Request $request)
	{
		return view('admin.tambah-user');
	}

		function addUser(Request $request)
	{
		$user = new User();
		$user->name = $request->name;
		$user->username = $request->username;
		$user->email = $request->email;
		$user->password = bcrypt($request->password);
		$user->user_role = $request->user_role;
		$user->save();
		return redirect('admin/daftar-user')->with('message','Berhasil menambah data user!');
	}

	function ubahUser(Request $request,$id)
	{
		$user = User::find($id);
		return view('admin.ubah-user',compact('user'));
	}

	function changeUser(Request $request)
	{
		$user = User::find($request->id);
		$user->name = $request->name;
		$user->username = $request->username;
		$user->email = $request->email;
		$user->password = bcrypt($request->password);
		$user->user_role = $request->user_role;
		$user->update();
		return redirect('admin/daftar-user')->with('message','Berhasil mengubah data user!');
	}

	function adminProfil(Request $request)
	{
		$id = Auth::user()->id;
		$admin = User::find($id);
		return view('admin.profil',compact('admin'));
	}
	function ubahProfil(Request $request)
	{
		$idUser = Auth::user()->id;
		$profil = User::find($idUser);
		return redirect('admin/profil')->with('message','Berhasil mengubah data Admin!');
	}

	function changeProfil(Request $request)
	{
		$idUser = Auth::user()->id;
		$user = User::find($idUser);
		$user->name = $request->name;
		$user->username = $request->username;
		$user->email = $request->email;
		$user->update();
		return redirect('admin/profil')->with('message','Berhasil mengubah data user!');	
	}

	function changePasswordAdmin(Request $request)
	{
		$idUser = Auth::user()->id;
		$user = User::find($idUser);
		$user->password = bcrypt($request->password);
		$user->update();
		return redirect('admin/profil')->with('messagePass','Berhasil mengubah password user!');	
	}

	function daftarSiswa(Request $request)
	{
		$kelas = DB::table('kelas')->get();
		$mapel = DB::table('mapel')->get();
		$siswa = DB::table('siswa')->select('siswa.*','kelas.kode_kelas')
				 ->join('kelas','siswa.kelas','=','kelas.id')->get();
		$guru = DB::table('guru')->get();		
		return view('admin.daftar-siswa',compact('siswa','guru','kelas','mapel'));
	}

	function tambahSiswa(Request $request)
	{
		$kelas = DB::table('kelas')->get();
		return view('admin.tambah-siswa',compact('kelas'));
	}

	function addSiswa(Request $request)
	{
		if($request->hasFile('foto')){
		$foto = $request->file('foto');
    	$namaFoto = $foto->getClientOriginalName();
    	$request->file('foto')->move("storage/siswa",$namaFoto);
    	
		}else{
			$namaFoto = NULL;
		}
		$siswa = new Siswa();
		$siswa->nisn = $request->nisn;
		$siswa->nama = $request->nama;
		$siswa->jk = $request->jk;
		$siswa->tahun_angk =$request->tahun_angk;
		$siswa->agama = $request->agama;
		$siswa->tempat_lahir = $request->tempat_lahir;
		$siswa->tanggal_lahir = $request->tanggal_lahir;
		$siswa->tanggal_masuk = $request->tanggal_masuk;
		$siswa->anak_ke = $request->anak_ke;
		$siswa->status = $request->status;
		$siswa->alamat = $request->alamat;
		$siswa->kelas = $request->kelas;
		$siswa->url_photo = $namaFoto;
		$siswa->nama_ayah = $request->nama_ayah;
		$siswa->pekerjaan_ayah = $request->pekerjaan_ayah;
		$siswa->nama_ibu = $request->nama_ibu;
		$siswa->pekerjaan_ibu = $request->pekerjaan_ibu;
		$siswa->alamat_ortu = $request->alamat_ortu;
		$siswa->no_ortu = $request->no_ortu;
		$siswa->nama_wali = $request->nama_wali;
		$siswa->pekerjaan_wali = $request->pekerjaan_wali;
		$siswa->alamat_wali = $request->alamat_wali;
		$siswa->no_wali = $request->no_wali;
		$siswa->save();	

		return redirect('admin/daftar-siswa')->with('message','Berhasil menambah data siswa!');
		
	}

	function ubahSiswa(Request $request,$id)
	{
		$siswa = Siswa::find($id);
		return view('admin.ubah-siswa',compact('siswa'));
	}

	function gantiFoto(Request $request)
	{
		if($request->hasFile('foto')){
			$siswa = Siswa::find($request->id);
			$foto = $request->file('foto');
    		$namaFoto = $foto->getClientOriginalName();
    		$request->file('foto')->move("storage/siswa",$namaFoto);
    		$report->url_photo = $namaFoto;
    		$report->update();
    		return view('admin/profil-siswa')->with('message','Berhasil Mengubah data!');
		}
	}
	function changeSiswa(Request $request)
	{

		$siswa = Siswa::find($request->id);
		$siswa->nisn = $request->nisn;
		$siswa->nama = $request->nama;
		$siswa->jk = $request->jk;
		$siswa->tahun_angk = $request->tahun_angk;
		$siswa->agama = $request->agama;
		$siswa->tempat_lahir = $request->tempat_lahir;
		$siswa->tanggal_lahir = date('Y-m-d',strtotime($request->tanggal_lahir));
		$siswa->tanggal_masuk = $request->tanggal_masuk;
		$siswa->anak_ke = $request->anak_ke;
		$siswa->status = $request->status;
		$siswa->alamat = $request->alamat;
		$siswa->tanggal_masuk = date('Y-m-d',strtotime($request->tanggal_masuk));
		$siswa->kelas = $request->kelas;
		$siswa->update();
		return redirect('admin/daftar-siswa')->with('message','Berhasil mengubah data siswa!');
	}

	function changeParentSiswa(Request $request)
	{
		$siswa = Siswa::find($request->id);
		
		$siswa->nama_ayah = $request->nama_ayah;
		$siswa->pekerjaan_ayah = $request->pekerjaan_ayah;
		$siswa->nama_ibu = $request->nama_ibu;
		$siswa->pekerjaan_ibu = $request->pekerjaan_ibu;
		$siswa->alamat_ortu = $request->alamat_ortu;
		$siswa->no_ortu = $request->no_ortu;
		$siswa->nama_wali = $request->nama_wali;
		$siswa->pekerjaan_wali = $request->pekerjaan_wali;
		$siswa->alamat_wali = $request->alamat_wali;
		$siswa->no_wali = $request->no_wali;
		$siswa->update();
		return redirect('admin/daftar-siswa')->with('message','Berhasil mengubah data siswa!');
	}

	function changePassSiswa(Request $request)
	{
		$siswa = Siswa::find($request->id);
		$siswa->password = bcrypt($request->password);
		$siswa->update();
		return redirect('admin/daftar-siswa')->with('message','Berhasil mengubah data siswa!');

	}
	function detailSiswa(Request $request,$id)
	{
		$kelas = DB::table('kelas')->get();
		// $mapel = DB::table('mapel')->count();
		// $guru = DB::table('guru')->get();	
		$siswa = Siswa::find($id)->select('siswa.*','kelas.kode_kelas')
				 ->join('kelas','siswa.kelas','=','kelas.id')->first();
		return view('admin.detail-siswa',compact('siswa','kelas'));
	}

		function daftarKelas(Request $request)
	{
		$kelas = DB::table('kelas')
				->join('guru','kelas.wali_kelas','=','guru.id')
				->select('kelas.*','guru.nama')
				->get();
		$mapel = DB::table('mapel')->count();
		$siswa = DB::table('siswa')->count();
		$guru = DB::table('guru')->count();	
		return view('admin.daftar-kelas',compact('kelas','siswa','mapel','guru'));
	}

	function detailKelas(Request $request,$id)
	{

		$guru = DB::table('guru')->get();		
		$kelas = Kelas::find($id);
		return view('admin.detail-kelas',compact('kelas','siswa','mapel','guru'));		
	}

	function tambahKelas(Request $request)
	{
		$guru = DB::table('guru')->get();
		$kelas = DB::table('kelas')->get();
		return view('admin.tambah-kelas',compact('guru','kelas'));
	}

	function addKelas(Request $request)
	{
		$kelas = new Kelas();
		$kelas->kode_kelas = $request->kode_kelas;
		$kelas->wali_kelas = $request->wali_kelas;
		$kelas->jml_siswa = $request->jml_siswa;
		$kelas->save();
		return redirect('admin/daftar-kelas')->with('message','Berhasil menambah data kelas!');
	}

	function ubahKelas(Request $request,$id)
	{
		$user = User::find($id);
		return view('admin.ubah-kelas',compact('user'));
	}

	function changeKelas(Request $request)
	{
		$kelas = Kelas::find($request->id);
		$kelas->kode_kelas = $request->kode_kelas;
		$kelas->wali_kelas = $request->wali_kelas;
		$kelas->jml_siswa = $request->jml_siswa;
		$kelas->update();
		return redirect('admin/daftar-kelas')->with('message','Berhasil mengubah data kelas!');
	}

		function daftarMapel(Request $request)
	{
		$kelas = DB::table('kelas')->count();
		$mapel = DB::table('mapel')->select('mapel.*','guru.nama','kelas.kode_kelas')
				 ->join('guru','mapel.id_guru','=','guru.id')
				 ->join('kelas','mapel.id_kelas','=','kelas.id')
				 ->get();
		$siswa = DB::table('siswa')->count();
		$guru = DB::table('guru')->count();	
		return view('admin.daftar-mapel',compact('mapel','siswa','kelas','guru'));
	}

	function detailMapel(Request $request,$id)
	{
		$guru = DB::table('guru')->get();
		$kelas = DB::table('kelas')->get();
		$mapel = Mapel::find($id);
		return view('admin.detail-mapel',compact('mapel','guru','kelas'));		
	}

	function tambahMapel(Request $request)
	{
		$guru = DB::table('guru')->get();
		$kelas = DB::table('kelas')->get();
		return view('admin.tambah-mapel',compact('guru','kelas')); 
	}

	function addMapel(Request $request)
	{
		$mapel = new Mapel();
		$mapel->nama_mapel = $request->nama_mapel;
		$mapel->id_kelas = $request->id_kelas;
		$mapel->id_guru = $request->id_guru;
		$mapel->kkm = $request->kkm;
		$mapel->save();
		return redirect('admin/daftar-mapel')->with('message','Berhasil menambah data mapel!');
	}

	function ubahMapel(Request $request,$id)
	{
		$user = User::find($id);
		return view('admin.ubah-mapel',compact('user'));
	}

	function changeMapel(Request $request)
	{
		$mapel = Mapel::find($request->id);
		$mapel->nama_mapel = $request->nama_mapel;
		$mapel->id_guru = $request->id_guru;
		$mapel->id_kelas = $request->id_kelas;
		$mapel->kkm = $request->kkm;
		$mapel->update();
		return redirect('admin/daftar-mapel')->with('message','Berhasil mengubah data mapel!');
	}

	function nilaiSiswa(Request $request)
	{
		$guru = DB::table('guru')->get();
		$siswa = DB::table('siswa')->get();
		$kelas = DB::table('kelas')->get();
		$mapel = DB::table('mapel')->get();
		$nilai = DB::table('nilai')->select('nilai.*','mapel.nama_mapel','guru.nama as nama_guru','kelas.kode_kelas','siswa.nama','daftar_nilai.*')
				 ->join('daftar_nilai','nilai.id_daftar_nilai','=','daftar_nilai.id')
				 ->join('kelas','daftar_nilai.id_kelas','=','kelas.id')
				 ->join('mapel','daftar_nilai.id_mapel','=','mapel.id')
				 ->join('guru','mapel.id_guru','=','guru.id')
				 ->join('siswa','nilai.nisn','=','siswa.nisn')
				 ->get();

				 return view('admin.daftar-nilai',compact('nilai','siswa','guru','kelas','mapel'));
	}

	    function inputNilai(Request $request)
    {
        $mapel = DB::table('mapel')->get();
        $kelas = DB::table('kelas')->get();
        $siswa = DB::table('siswa')->get();
        $guru = DB::table('guru')->get();       
        return view('admin.tambah-nilai-siswa',compact('mapel','kelas','siswa','guru'));
    }

    function addNilai(Request $request)
    {
        $data = array('id_daftar_nilai'=>$request->id,'nisn'=>$request->nisn,'nilai'=>$request->nilai);

        Nilai::insert($data);
        return redirect('admin/daftar_nilai')->with('message','Sukses menambah data nilai siswa!');
    }

    function postDaftarNilai(Request $request)
    {
        $biji = new DaftarNilai();
        $biji->id_kelas = $request->id_kelas;
        $biji->id_mapel = $request->id_mapel;
        $biji->semester = $request->semester;
        $biji->tahun_ajaran = $request->tahun_ajaran;
        $biji->save();
        return redirect('admin/daftar-nilai')->with('message','Berhasil menambah data nilai!');
    }

    function tambahNilai(Request $request,$id)
    {
        $data = DB::table('daftar_nilai')->select('daftar_nilai.id','kelas.kode_kelas','mapel.nama_mapel')
                ->join('kelas','daftar_nilai.id_kelas','=','kelas.id')
                ->join('mapel','daftar_nilai.id_mapel','=','mapel.id')
                ->where('kelas.id','=',$id)->first();
        $siswa = DB::table('siswa')->select('siswa.*')->where('siswa.kelas','=',$id)->orderBy('siswa.nama','DESC')->get();
        return view('admin.tambah-nilai-siswa',compact('data','siswa'));
    }

    function detailNilai(Request $request,$id)
    {
        $nilai = DB::table('nilai')->select('nilai.*','mapel.nama_mapel','siswa.nama','kelas.kode_kelas')
                 ->join('daftar_nilai','nilai.id_daftar_nilai','=','daftar_nilai.id')
                 ->join('siswa','nilai.nisn','=','siswa.nisn')
                 ->join('mapel','daftar_nilai.id_mapel','=','mapel.id')
                 ->join('kelas','daftar_nilai.id_kelas','=','kelas.id')
                 ->where('daftar_nilai.id','=',$id)
                 ->get();

        $id_daftar_nilai  = DB::table('daftar_nilai')->where('id','=',$id)->first();

       $mapel = DB::table('mapel')->select('mapel.nama_mapel')->join('daftar_nilai','mapel.id','=','daftar_nilai.id_mapel')
                ->where('daftar_nilai.id','=',$id)->first();
        $kelas = Kelas::findOrFail($id);
    return view('admin.detail-nilai',compact('nilai','mapel','kelas','id_daftar_nilai'));   
    
    }

    function ubahNilai(Request $request, $id)
    {
        $nilai = DB::table('nilai')->select('nilai.nilai')->where('nilai.id','=',$id)->first();

        return view('guru.ubah-nilai',compact('nilai'));
    }

    function postChangeNilai(Request $request,$id)
    {
        $biji = Nilai::findOrFail($id);
        $biji->nilai = $request->nilai;
        $biji->update();
        // return redirect('admin/daftar-nilai')->with('message','Berhasil mengubah data nilai!');   
        return back()->with('message','Berhasil mengubah data nilai!');  
    }

        function daftarMapelMateri(Request $request)
    {
        $mapel = DB::table('mapel')->select('mapel.id','mapel.nama_mapel','kelas.kode_kelas')
                 ->join('kelas','mapel.id_kelas','=','kelas.id')->get();
        $kelas = DB::table('kelas')->count();
        $siswa = DB::table('siswa')->count();
        $guru = DB::table('guru')->count();
        return view('admin.daftar-mapel-materi',compact('mapel','kelas','siswa','guru'));
    }

    function daftarMateri(Request $request,$id)
    {
         $mapel1 = DB::table('mapel')->where('mapel.id','=',$id)->first();
        $mapel = DB::table('mapel')->count();
        $kelas = DB::table('kelas')->count();
        $siswa = DB::table('siswa')->count();
        $guru = DB::table('guru')->count();
        $materi = DB::table('materi')->select('materi.*','guru.nama as nama_guru')
                  ->join('guru','materi.id_guru','=','guru.id')
                  ->join('mapel','materi.id_mapel','=','mapel.id')
                  ->where('mapel.id','=',$id)
                  ->orderBy('materi.created_at','DESC')
                  ->get();

        return view('admin.daftar-materi',compact('materi','mapel','kelas','siswa','guru','mapel1'));
            // return 'asdasd';
    }

    function tambahMateri(Request $request,$id)
    {
        $mapel = DB::table('mapel')->where('mapel.id','=',$id)->first();
        $guru = DB::table('guru')->get();
        return view('admin.tambah-materi',compact('mapel','guru'));
        
    }

    function addMateri(Request $request)
    {
        if($request->hasFile('file_materi')){
            $materi = new Materi();
            $materi->judul = $request->judul;
            $materi->deskripsi = $request->deskripsi;
            $materi->id_guru = $request->id_guru;
            $materi->id_mapel = $request->id_mapel;

            $file_materi = $request->file('file_materi');
            $namaMateri = $file_materi->getClientOriginalName();
            $request->file('file_materi')->move(storage_path()."/app/public/materi",$namaMateri);
            $materi->url_file = $namaMateri;
            $materi->save();
            return redirect('/admin/materi/')->with('message','Berhasil menambah data materi!');
            // return "berhasil";
        }else{
            // echo "tidak ada file";
            // return back()->with('message','File tidak ada! Coba lagi');
            return "gagal";
        }
    }

    protected function downloadMateri(Request $request,$id)
    {
        $mapel = DB::table('materi')->select('mapel.nama_mapel')
                 ->join('mapel','materi.id_mapel','=','mapel.id')
                 ->where('materi.id_mapel','=',$id)->first();
        $materi = DB::table('materi')->select('*')->where('materi.id','=',$id)->first();
        $myFile = storage_path('public/materi/'.$materi->url_file);
        // $headers = ['Content-Type: application/pdf'];
        $newName = 'materi'.date('d:m:Y',strtotime($materi->created_at)).'-'.$materi->url_file;
        
        if(file_exists($myFile))
        {
            return response()->download($myFile, $newName);    
        }else{
            return redirect()->back()->with('messageErr','File hilang, silahkan data materi dihapus!');
        }
    }

    function hapusMateri(Request $request,$id)
    {
    	Materi::find($id)->delete();
    	return back()->with('message','Berhasil menghapus data materi');
    }


}
