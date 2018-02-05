@extends('layouts.admin')
@section('titlePageAdmin','Dashboard - Sistem Informasi Akademik')
@section('content')
 <section class="content-header">
      <h1>
        SIAKADEMIK
        <small>Version 1.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>
<section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"></span>

            <div class="info-box-content">
              <span class="info-box-text">Jumlah Siswa</span>
              <span class="info-box-number"><?php echo count($siswa) ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"></span>

            <div class="info-box-content">
              <span class="info-box-text">Jumlah Guru</span>
              <span class="info-box-number"><?php echo count($guru) ?></span>
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
            <span class="info-box-icon bg-green"></span>

            <div class="info-box-content">
              <span class="info-box-text">Mata Pelajaran</span>
              <span class="info-box-number"><?php echo count($mapel)?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"></span>

            <div class="info-box-content">
              <span class="info-box-text">Jumlah Kelas</span>
              <span class="info-box-number"><?php echo count($kelas)?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Guru </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
               
                <!-- /.col -->
               <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>NIP</th>
                  <th>Nama</th>
                  <th>Gender</th>
                  <th>Golongan</th>
                  <th>Status</th>
                  <th>Tanggal Lahir</th>
                  <th>Tanggal Masuk</th>
                  <th>Alamat</th>
                  <th>No Telp/HP</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; ?>
                  @forelse($guru as $data)
               <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $data->nip; ?></td>
                <td><?php echo $data->nama; ?></td>
                <td><?php echo $data->jk; ?></td>
                <td><?php echo $data->gol; ?></td>
                <td><?php echo $data->status; ?></td>
                <td><?php echo $data->tgl_lahir; ?></td>
                <td><?php echo $data->tgl_masuk; ?></td>
                <td><?php echo $data->alamat; ?></td>
                <td><?php echo $data->no_telp; ?></td>
                <td><a href="detail-guru/{{$data->id}}" class="btn btn-primary">Lihat</a> | <a href="ubah-guru/{{$data->id}}">Ubah</a> | <a href="hapus-guru/{{$data->id}}">Hapus</a></td>
               </tr>
               @empty
               <tr>
                <td><label class="alert alert-danger" position="center">Kosong</label></td>
               </tr>
               @endforelse
                </tbody>
                <tfoot>
                <tr>
                  <th>No.</th>
                  <th>NIP</th>
                  <th>Nama</th>
                  <th>Gender</th>
                  <th>Golongan</th>
                  <th>Status</th>
                  <th>Tanggal Lahir</th>
                  <th>Tanggal Masuk</th>
                  <th>Alamat</th>
                  <th>No Telp/HP</th>
                  <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
                <!-- /.col -->
              </div>
              <!-- /.row -->
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