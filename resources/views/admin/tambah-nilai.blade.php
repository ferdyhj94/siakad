@extends('layouts.admin') 
@section('titlePageAdmin','Tambah Data Nilai - Sistem Informasi Akademik')
@section('content')

  <section class="content-header">
      <h1>
        Tambah Data Nilai
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('admin.daftarNilai')}}">Daftar Nilai</a></li>
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
            <form role="form" method="post" action="{{route('postDaftarNilai')}}">
              {{csrf_field()}}
              <div class="box-body">
              <div class="form-group">
                  <label>Semester</label>
                  <input type="text" class="form-control" placeholder="Semester" name="semester" required>
                </div>
                <div class="form-group">
                  <label>Tahun Ajaran</label>
                  <input type="text" class="form-control" placeholder="Tahun Ajaran" name="tahun_ajaran" required>
                </div>
                  
                <div class="form-group">
                  <label>Mata Pelajaran</label>
                  <select class="form-control" name="id_mapel">
                    @foreach($mapel as $data)
                    <option value="<?php echo $data->id?>">{{$data->nama_mapel}}</option>
                    @endforeach
                  </select>
                </div>
    
                <div class="form-group">
                    <label>Kelas</label>
                   <select class="form-control" name="id_kelas">
                    <option disabled>Pilih kelas... </option>                          
                    @foreach($kelas as $class)
                    <option value="{{$class->id}}">{{$class->kode_kelas}}</option>
                    @endforeach
                  </select>        
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