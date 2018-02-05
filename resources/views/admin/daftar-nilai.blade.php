@extends('layouts.admin')
@section('titlePageAdmin','Daftar Nilai - Sistem Informasi Akademik')
@section('content')
 <section class="content-header">
      <h1>
        SIAKADEMIK
        <small>Version 1.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Daftar Nilai</li>
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
              <span class="info-box-number"><?php echo count($siswa) ?></span>
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
              <span class="info-box-number"><?php echo count($nilai) ?></span>
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
              <span class="info-box-number"><?php echo count($mapel)?></span>
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
        <div class="col-lg-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Nilai</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                      @if(Session::has('message'))
<div class="alert alert-success" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
     <span aria-hidden="true">&times;</span>
</button>{{Session::get('message')}}</div>
@endif
              
               <div style="margin-left:30px; margin-bottom:20px;">
              <a href="{{url('admin/tambah-nilai')}}" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i></a>
          </div>
               
                <!-- /.col -->
               <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Mata Pelajaran</th>
                  <th>Guru Pengajar</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; ?>
                  @forelse($nilai as $data)
               <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data->nama_mapel; ?></td>
                <td><?php echo $data->nama_guru; ?></td>
                <td><a href="detail-nilai/{{$data->id}}" class="btn btn-primary">Lihat</a></td>
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
                  <th>Mata Pelajaran</th>
                  <th>Guru Pengajar</th>
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
  <script>
    window.setTimeout(function() {
    $(".alert").fadeTo(200, 0).slideUp(300, function(){
        $(this).remove(); 
    });
}, 4000);
    </script>

    </section>
@endsection