@extends('layouts.admin') 
@section('titlePageAdmin','Tambah Data Mata Pelajaran - Sistem Informasi Akademik')
@section('content')

  <section class="content-header">
      <h1>
        Tambah Data Mata Pelajaran
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('daftarMapel')}}">Daftar Mata Pelajaran</a></li>
        <li class="active">Tambah Data</li>
      </ol>
    </section>

    <section class="content">
            <div class="row">
        <!-- left column -->
        <div class="col-md-10">
    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Mata Pelajaran</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{url('admin/addMapel')}}">
              {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label>Mata Pelajaran</label>
                  <input type="text" class="form-control" placeholder="Mata Pelajaran" name="nama_mapel" required>
                </div>
    
                <div class="form-group">

                  <label>Guru Pengajar</label>
                  <select class="form-control" name="id_guru">
                    @foreach($guru as $data)
                    <option value="<?php echo $data->id?>">{{$data->nama}}</option>
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
     
                <div class="form-group">
                  <label>KKM</label>
                  <input type="text" class="form-control" placeholder="KKM" name="kkm" required>
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