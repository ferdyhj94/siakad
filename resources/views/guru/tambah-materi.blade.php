@extends('layouts.admin') 
@section('titlePageAdmin','Tambah Data Mata Pelajaran - Sistem Informasi Akademik')
@section('content')

  <section class="content-header">
      <h1>
        Tambah Data Mata Pelajaran
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('guru/materi')}}">Daftar Materi</a></li>
        <li class="active">Tambah Data</li>

      </ol>
    </section>

    <section class="content">
            <div class="row">
        <!-- left column -->
        <div class="col-md-10">
    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Masukkan Data Materi {{$mapel->nama_mapel}}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{url('/guru/materi/addMateri')}}" files="true" enctype="multipart/form-data">
              <input name="id" value="{{$mapel->id}}" type="hidden">
              {{csrf_field()}}
              <div class="box-body"> 
                <div class="form-group">
                  <label>Judul</label>
                  <input type="text" class="form-control" name="judul">
                </div>
                <div class="form-group">
                  <label>Deskrpsi</label>
                  <textarea class="form-control" name="deskripsi"></textarea>
                </div>
                <div class="form-group">
                  <label>Guru</label>
                  <select class="form-control" name="id_guru">
                    <option disabled>Pilih guru... </option>                          
                    @foreach($guru as $dataGuru)
                    <option value="{{$dataGuru->id}}">{{$dataGuru->nama}}</option>
                    @endforeach
                  </select>        
                 </
                </div>               
                  <input type="hidden" class="form-control" name="id_mapel" value="{{$mapel->id}}">
              <div class="form-group">
                  <label>File Materi</label>
                  <input type="file" class="form-control" name="file_materi" required>
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