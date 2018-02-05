@extends('layouts.admin') 
@section('titlePageAdmin','Tambah Data Mata Pelajaran - Sistem Informasi Akademik')
@section('content')

  <section class="content-header">
      <h1>
        Tambah Data Mata Pelajaran
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('daftarMapel')}}">Daftar Nilai</a></li>
        <li class="active">Tambah Data</li>

      </ol>
    </section>

    <section class="content">
            <div class="row">
        <!-- left column -->
        <div class="col-md-10">
    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Masukkan Data Nilai</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{url('admin/addNilai')}}">
              <input name="id" value="{{$data->id}}" type="hidden">
              {{csrf_field()}}
              <div class="box-body"> 
                <div class="form-group">
                  <label>Mata Pelajaran</label>
                  <input type="text" class="form-control" value="{{$data->nama_mapel}}" disabled>
                </div>
                <div class="form-group">
                  <label>Kelas</label>
                  <input type="text" class="form-control" value="{{$data->kode_kelas}}" disabled>
                </div>
                 <div class="form-group">
                    <label>Nama Siswa</label>
                   <select class="form-control" name="nisn">
                    <option disabled>Pilih siswa... </option>                          
                    @foreach($siswa as $datasiswa)
                    <option value="{{$datasiswa->nisn}}">{{$datasiswa->nama}}</option>
                    @endforeach
                  </select>        
                 </div>            
              <div class="form-group">
                  <label>Nilai</label>
                  <input type="text" class="form-control" placeholder="Nilai" name="nilai" required>
                </div>

              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
         </div>  
      </div>
          </section> 

@endsection