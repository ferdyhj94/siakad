@extends('layouts.admin') 
@section('titlePageAdmin','Tambah Data Kelas - Sistem Informasi Akademik')
@section('content')

  <section class="content-header">
      <h1>
        Tambah Data Kelas
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('daftarKelas')}}">Daftar Kelas</a></li>
        <li class="active">Tambah Data</li>
      </ol>
    </section>

    <section class="content">
            <div class="row">
        <!-- left column -->
        <div class="col-md-10">
    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Kelas</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{url('admin/addKelas')}}">
              {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label>Kode Kelas</label>
                  <input type="text" class="form-control" placeholder="Kode Kelas" name="kode_kelas" required>
                </div>
                <div class="form-group">
                    <label>Guru Pengampu</label>
                        <select class="form-control" name="wali_kelas">
                    <option disabled>Pilih guru... </option>             
                    @forelse($guru as $data)             
                    <option value="{{$data->id}}">{{$data->nama}}</option>
                    @empty
                    <option value="#">Kosong!</option>
                    @endforelse
                  </select>        
                  </div>
                <div class="form-group">
                  <label>Jumlah Siswa</label>
                  <input type="text" class="form-control" placeholder="Jumlah Siswa" name="jml_siswa" required>
               
            </div>
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