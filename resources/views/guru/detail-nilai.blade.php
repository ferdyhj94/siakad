@extends('layouts.admin')
@section('titlePageAdmin','Daftar kelas - Sistem Informasi Akademik')
@section('content')
 <section class="content-header">
      <h1>
        SIAKADEMIK
        <small>Version 1.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Daftar Nilai <strong>{{$mapel->nama_mapel}}</strong></li>
      </ol>
    </section>
<section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jumlah Siswa</span>
              <span class="info-box-number">45</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jumlah Guru</span>
              <span class="info-box-number">34</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Mata Pelajaran</span>
              <span class="info-box-number">14</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Jumlah Kelas</span>
              <span class="info-box-number">8</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


      <div class="row"> 
        <div class="col-lg-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Nilai {{$mapel->nama_mapel}} kelas {{$kelas->kode_kelas}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(Session::has('message'))
<div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
@endif
              
               <div style="margin-left:30px; margin-bottom:20px;">
              <a href="{{route('guru.inputNilai')}}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i></a>
              <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Download Data<span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li><a href="/guru/download-nilai/<?php echo $id_daftar_nilai->id; ?>/xls"><button class="btn btn-success">Download Excel sebagai xls</button></a></li>
                <li><a href="/guru/download-nilai/<?php echo $id_daftar_nilai->id; ?>/xlsx"><button class="btn btn-success">Download Excel sebagai xlsx</button></a></li>
                <li><a href="/guru/download-nilai/<?php echo $id_daftar_nilai->id; ?>/csv"><button class="btn btn-success">Download sebagai CSV</button></a></li>                
                <li><a href="/guru/download-nilai-pdf/<?php echo $id_daftar_nilai->id; ?>"><button class="btn btn-success">Download sebagai PDF</button></a></li>
                <!-- downloadNilaiPDF? -->
              </ul>
              </div>
          </div>
               
                <!-- /.col -->
             <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>NISN</th>
                  <th>Nama</th>
                  <th>Nilai</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; ?>
                  @forelse($nilai as $data)
               <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data->nisn; ?></td>
                <td><?php echo $data->nama; ?></td>
                <td><?php echo $data->nilai?></td>
                <td><a class="btn btn-warning" data-toggle="modal"  href="#ubahNilai{{$data->id}}">Ubah Nilai</a></td>
               </tr>

               <div class="modal fade" id="ubahNilai{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">

                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="exampleModalLabel">Nilai</h4>
                        </div>
                        <div class="modal-body">
                          <form method="post" action="postChangeNilai/{{$data->id}}" role="form">
                            {{csrf_field()}}
                            <div class="form-group">
                              <label for="recipient-name" class="control-label">Nilai {{$data->nama}}</label>
                              <input type="text" value="{{$data->nilai}}" class="form-control" name="nilai">
                            </div>
                          
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
               @empty
               <tr>
                <td><span class="alert alert-danger">Kosong</span></td>
               </tr>
               @endforelse
                </tbody>
                <tfoot>
                <tr>
                  <th>No.</th>
                  <th>NISN</th>
                  <th>Nama</th>
                  <th>Nilai</th>
                  <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
                <!-- /.col -->

            </div>
            <!-- ./box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
@endsection
