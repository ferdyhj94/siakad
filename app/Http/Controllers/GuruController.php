<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use App\User;
use App\Guru;
use App\Siswa;
use App\Kelas;
use App\DaftarNilai;
use App\Materi;

use App\Nilai;
use Redirect;
use Auth;
use PDF;

class GuruController extends Controller
{

    function dashboardGuru(Request $request)
    {
        $mapel = DB::table('mapel')->count();
        $kelas = DB::table('kelas')->count();
        $siswa = DB::table('siswa')->count();
        $guru = DB::table('guru')->get();
		return view('admin.dashboard',compact('siswa','guru'));
    }

    function profilGuru(Request $request)
    {
    	$userId = Auth::user()->id;
    	$userProfil = User::find($userId);
    	$profil = Guru::where('nip','=',Auth::user()->username);
    	return view('guru.profil',compact('profil'));
    }

    function editProfilGuru(Request $request)
    {
    	$userId = Auth::user()->id;
    	$profil = User::find($userId);
    	$profil->nip = $request->nip;
    	$profil->nama = $request->nama;
    	$profil->jk = $request->jk;
    	$profil->gol = $request->gol;
    	$profil->status = $request->status;
    	$profil->tgl_lahir = $request->tgl_lahir;
    	$profil->alamat = $request->alamat;
    	$profil->no_telp = $request->no_telp;
    	$profil->update();
    	return redirect('guru/profil')->with('messageSuccess','Berhasil mengubah data diri!');
    } 

    function inputNilai(Request $request)
    {
        $mapel = DB::table('mapel')->get();
        $kelas = DB::table('kelas')->get();
        $siswa = DB::table('siswa')->get();
        $guru = DB::table('guru')->get();       
        return view('guru.tambah-nilai',compact('mapel','kelas','siswa','guru'));
    }

    function addNilai(Request $request)
    {
        $data = array('id_daftar_nilai'=>$request->id,'nisn'=>$request->nisn,'nilai'=>$request->nilai);

        Nilai::insert($data);
        return redirect('guru/daftar-nilai')->with('message','Sukses menambah data nilai siswa!');
    }

    function postDaftarNilai(Request $request)
    {
        $biji = new DaftarNilai();
        $biji->id_kelas = $request->id_kelas;
        $biji->id_mapel = $request->id_mapel;
        $biji->semester = $request->semester;
        $biji->tahun_ajaran = $request->tahun_ajaran;
        $biji->save();
        return redirect('guru/daftar-nilai')->with('message','Berhasil menambah data nilai!');
    }

    function tambahNilai(Request $request,$id)
    {
        $data = DB::table('daftar_nilai')->select('daftar_nilai.id','kelas.kode_kelas','mapel.nama_mapel')
                ->join('kelas','daftar_nilai.id_kelas','=','kelas.id')
                ->join('mapel','daftar_nilai.id_mapel','=','mapel.id')
                ->where('kelas.id','=',$id)->first();
        $siswa = DB::table('siswa')->select('siswa.*')->where('siswa.kelas','=',$id)->orderBy('siswa.nama','DESC')->get();
        return view('guru.tambah-nilai-siswa',compact('data','siswa'));
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
    return view('guru.detail-nilai',compact('nilai','mapel','kelas','id_daftar_nilai'));   
    
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

        function nilaiSiswa(Request $request)
    {
        $guru = DB::table('guru')->get();
        $siswa = DB::table('siswa')->get();
        $kelas = DB::table('kelas')->get();
        $mapel = DB::table('mapel')->get();
        $nilai = DB::table('daftar_nilai')->select('daftar_nilai.*','mapel.nama_mapel','guru.nama as nama_guru','kelas.kode_kelas')
                 ->join('kelas','daftar_nilai.id_kelas','=','kelas.id')
                 ->join('mapel','daftar_nilai.id_mapel','=','mapel.id')
                 ->join('guru','mapel.id_guru','=','guru.id')
                 ->get();

                 return view('guru.daftar-nilai',compact('nilai','siswa','guru','kelas','mapel'));
    }


    function daftarMapelMateri(Request $request)
    {
        $mapel = DB::table('mapel')->select('mapel.id','mapel.nama_mapel','kelas.kode_kelas')
                 ->join('kelas','mapel.id_kelas','=','kelas.id')->get();
        $kelas = DB::table('kelas')->count();
        $siswa = DB::table('siswa')->count();
        $guru = DB::table('guru')->count();
        return view('guru.daftar-mapel-materi',compact('mapel','kelas','siswa','guru'));
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

        return view('guru.daftar-materi',compact('materi','mapel','kelas','siswa','guru','mapel1'));
            // return 'asdasd';
    }

    function tambahMateri(Request $request,$id)
    {
        $mapel = DB::table('mapel')->where('mapel.id','=',$id)->first();
        $guru = DB::table('guru')->get();
        return view('guru.tambah-materi',compact('mapel','guru'));
        
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
            return redirect('/guru/materi/')->with('message','Berhasil menambah data materi!');
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

        public function downloadNilaiExcel(Request $request,$id,$type)

    {

        $data = Nilai::select('siswa.nisn','siswa.nama','kelas.kode_kelas as Kelas', 'mapel.nama_mapel as Mata Pelajaran','daftar_nilai.semester', 'daftar_nilai.tahun_ajaran AS Tahun Ajaran', 'nilai.nilai')
                ->join('daftar_nilai','nilai.id_daftar_nilai','=','daftar_nilai.id')
                ->join('siswa','nilai.nisn','=','siswa.nisn')
                ->join('kelas','daftar_nilai.id_kelas','=','kelas.id')
                ->join('mapel','daftar_nilai.id_mapel','=','mapel.id')
                ->where('daftar_nilai.id','=',$id)
                ->get()->toArray();

        $kelas = DaftarNilai::select('daftar_nilai.*','kelas.kode_kelas')
                 ->join('kelas','daftar_nilai.id_kelas','=','kelas.id')
                 ->where('daftar_nilai.id','=',$id)->first();

        return Excel::create('downloadNilai', function($excel) use ($data,$kelas) {
            $excel->setTitle('Nilai s'.$kelas->kode_kelas);
            $excel->sheet('Sheet 1', function($sheet) use ($data)

            {

                $sheet->fromArray($data);

            });

        })->download($type);

    }

    public function importExcel()

    {

        if(Input::hasFile('import_file')){

            $path = Input::file('import_file')->getRealPath();

            $data = \Excel::load($path, function($reader) {

            })->get();

            if(!empty($data) && $data->count()){

                foreach ($data as $key => $value) {

                    $insert[] = ['title' => $value->title, 'description' => $value->description];

                }

                if(!empty($insert)){

                    DB::table('items')->insert($insert);

                    dd('Insert Record successfully.');

                }

            }

        }

        return back();

    }

     public function downloadNilaiPDF(Request $request,$id)

    {

        $data = Nilai::select('siswa.nisn','siswa.nama','kelas.kode_kelas', 'mapel.nama_mapel','daftar_nilai.semester', 'daftar_nilai.tahun_ajaran', 'nilai.nilai')
                ->join('daftar_nilai','nilai.id_daftar_nilai','=','daftar_nilai.id')
                ->join('siswa','nilai.nisn','=','siswa.nisn')
                ->join('kelas','daftar_nilai.id_kelas','=','kelas.id')
                ->join('mapel','daftar_nilai.id_mapel','=','mapel.id')
                ->where('daftar_nilai.id','=',$id)
                ->get();

        $kelas = DaftarNilai::select('daftar_nilai.*','kelas.kode_kelas')
                 ->join('kelas','daftar_nilai.id_kelas','=','kelas.id')
                 ->where('daftar_nilai.id','=',$id)->first();

// set ukuran kertas dan orientasi
$pdf = PDF::loadView('guru.daftar-nilai-pdf',compact('data','kelas'))->setPaper('a4','portrait');
// return $pdf->download('Nilai.pdf');
return $pdf->stream();
    }
    
}
