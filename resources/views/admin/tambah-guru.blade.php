@extends('layouts.admin') 
@section('titlePageAdmin','Tambah Data Guru - Sistem Informasi Akademik')
@section('content')

  <section class="content-header">
      <h1>
        Tambah Data Guru
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('admin.daftarGuru')}}">Daftar Guru</a></li>
        <li class="active">Tambah Data</li>
      </ol>
    </section>

    <section class="content">
            <div class="row">
        <!-- left column -->
        <div class="col-md-10">
    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Guru</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{url('admin/addGuru')}}" files="true" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label>NIP</label>
                  <input type="text" class="form-control" placeholder="NIP" name="nip" required>
                </div>
                 <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" placeholder="Nama" name="nama" required>
                </div>
                <div class="form-group">
                  <label>Jenis Kelamin</label>
                  <select class="form-control" name="jk">
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                  </select>
                </div>
                <div class="form-group">
                    <label>Agama</label>

                   
                        <select class="form-control" name="agama">
                    <option disabled>Pilih agama... </option>                          
                    <option value="islam">Islam </option>
                    <option value="katholik">Katholik</option>
                    <option value="kristen">Kristen </option>
                    <option value="hindu">Hindu</option>
                    <option value="budha">Budha</option>
                  </select>        
  
                  </div>
                  <div class="form-group">
                  <label>Tempat Lahir</label>
                  <input type="text" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir" required>
                </div>
                <div class="form-group">
                  <label>Tanggal lahir</label>
                    <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tgl_lahir" class="form-control pull-right" id="datepicker" required>
                </div>
                </div>
                <div class="form-group">
                  <label>Tanggal Masuk</label>
                  <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="tgl_masuk" class="form-control pull-right" id="datepicker" required>
                </div>
                </div>             
                <div class="form-group">
                  <label>Alamat</label>
                  <textarea class="form-control" placeholder="Alamat" name="alamat" required></textarea>
                </div>             
                <div class="form-group">
                  <label>No. Telp/HP</label>
                  <input type="text" class="form-control" placeholder="No. Telp/HP" name="no_telp" required>
                </div>             
                <div class="form-group">
                  <label>Foto</label>
                  <input type="file" name="foto">
                  <p class="help-block">Max 300 kb</p>
                  <p class="help-block">Nama Harus sesuai NIP</p>
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