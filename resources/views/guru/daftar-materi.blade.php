@extends('layouts.admin')
@section('titlePageAdmin','Daftar Materi - Sistem Informasi Akademik')
@section('content')
 <section class="content-header">
      <h1>
        SIAKADEMIK
        <small>Version 1.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Daftar Materi</li>
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
              <span class="info-box-number"><?php echo $siswa ?></span>
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
              <span class="info-box-number"><?php echo $guru ?></span>
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
              <span class="info-box-number"><?php echo $mapel?></span>
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
              <span class="info-box-number"><?php echo $kelas?></span>
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
              <h3 class="box-title">Daftar Materi {{$mapel1->nama_mapel}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(Session::has('message'))
<div class="alert alert-success" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>{{Session::get('message')}}</div>
@elseif(Session::has('messageErr'))
<div class="alert alert-danger" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>{{Session::get('messageErr')}}</div>
@endif
              
               <div style="margin-left:30px; margin-bottom:20px;">
              <a href="/guru/materi/tambah-materi/{{$mapel1->id}}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i></a>
          </div>
               
                <!-- /.col -->
               <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Judul</th>                
                  <th>Guru</th>
                  <th>Tanggal</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; ?>
                  @forelse($materi as $data)
               <tr>
                <td><?php echo $no++; ?></td>
                <td><a href="/guru/materi/download-materi/{{$data->id}}"><?php echo $data->judul; ?></a></td>
                <td><?php echo $data->nama_guru; ?></td>
                <td><?php echo date("d-m-Y",strtotime($data->created_at)) ?></td>
                <td><a href="hapus-materi/{{$data->id}}" class="btn btn-primary">Hapus</a></td>
               </tr>
               @empty
               <tr>
                <td><span class="alert alert-danger">Kosong</span></td>
               </tr>
               @endforelse
                </tbody>
                <tfoot>
                <tr>
                  <th>No.</th>
                  <th>Judul</th>                
                  <th>Guru</th>
                  <th>Tanggal</th>
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
      </d
      iv>
      <!-- /.row -->

    </section>
    <script>
window.setTimeout(function() {
    $(".alert").fadeTo(200, 0).slideUp(300, function(){
        $(this).remove(); 
    });
}, 4000);
    </script>
@endsection