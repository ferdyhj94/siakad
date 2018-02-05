@extends('layouts.admin')
@section('titlePageAdmin','Detail Siswa - Sistem Informasi Akademik ')
@section('content')

 <section class="content-header">
      <h1>
        Profil Siswa
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('dashboardAdmin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('admin.daftarSiswa')}}">Siswa</a></li>
        <li class="active">Profil Siswa</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="Gambar profil Siswa ">

              <h3 class="profile-username text-center">{{$siswa->nama}}</h3>

              <p class="text-muted text-center">{{$siswa->nisn}}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Kelas</b> <a class="pull-right">{{$siswa->kode_kelas}}</a>
                </li>
                <li class="list-group-item">
                  <?php if($siswa->jk=='L'){?>
                  <b>Jenis Kelamin</b> <a class="pull-right">L</a>
                    <?php } elseif($siswa->jk=='P') { ?>
                  <b>Jenis Kelamin</b> <a class="pull-right">P</a>
                  <?php } ?>
                </li>
                <li class="list-group-item">
                  @if($siswa->status=='aktif')
                  <b>Status</b> <a class="pull-right"><label class="label label-success">Aktif</label></a>
                  @else
                  <b>Status</b> <a class="pull-right"><label class="label label-danger">Tidak Aktif</label></a>
                  @endif
                </li>
              </ul>

              <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
       
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#personalId" data-toggle="tab">Data Personal</a></li>
              <li><a href="#parentsId" data-toggle="tab">Data Orang Tua/Wali</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="personalId">
    <form class="form-horizontal" method="post" action="{{url('admin/changeSiswa')}}">
      {{csrf_field()}}
      <input type="hidden" value="{{$siswa->id}}" name="id">
                  <div class="form-group">
                    <label  class="col-sm-2 control-label">Nama</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Nama" value="{{$siswa->nama}}" name="nama" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">NISN</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="NISN" value="{{$siswa->nisn}}" name="nisn" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Jenis Kelamin</label>

                    <div class="col-sm-10">
                   <select class="form-control" name="jk">
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                  </select>         
                     </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Tahun Angkatan</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Experience" value="{{$siswa->tahun_angk}}" name="tahun_angk" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Agama</label>

                    <div class="col-sm-10">
                        <select class="form-control" name="agama">
                    <option disabled>Pilih agama... </option>                          
                    <option value="islam">Islam </option>
                    <option value="katholik">Katholik</option>
                    <option value="kristen">Kristen </option>
                    <option value="hindu">Hindu</option>
                    <option value="budha">Budha</option>
                  </select>        
                    </div>
                  </div>
                   <div class="form-group">
                    <label class="col-sm-2 control-label">Tempat Lahir</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Tempat Lahir" value="{{$siswa->tempat_lahir}}" name="tempat_lahir" required>
                    </div>
                  </div>
                   <div class="form-group">
                    <label class="col-sm-2 control-label">Tanggal Lahir</label>

                    <div class="col-sm-10">
                     <div class="input-group date">
                     <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                     </div>
                  <input type="text" class="form-control pull-right" id="datepicker" value="<?php echo date('d/m/Y',strtotime($siswa->tanggal_lahir)) ?>" name="tanggal_lahir">
                </div>
                    </div>
                  </div>
                   <div class="form-group">
                    <label class="col-sm-2 control-label">Anak Ke-</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Anak Ke-" value="{{$siswa->anak_ke}}" name="anak_ke" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Status" value="{{$siswa->status}}" name="status" required>
                    </div>
                  </div>
                 <div class="form-group">
                    <label class="col-sm-2 control-label">Alamat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Alamat" value="{{$siswa->alamat}}" name="alamat" required>
                    </div>
                  </div>
                 <div class="form-group">
                    <label class="col-sm-2 control-label">Tanggal Masuk</label>
                    
                       <div class="col-sm-10">
                     <div class="input-group date">
                     <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                     </div>
                  <input type="text" class="form-control pull-right" id="datepicker" value="<?php echo date('d/m/Y',strtotime($siswa->tanggal_masuk)) ?>" name="tanggal_lahir">
                </div>
                 
                    </div>
                  </div>
                   <div class="form-group">
                    <label class="col-sm-2 control-label">Kelas</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Kelas" value="{{$siswa->kelas}}" name="kelas" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-warning">Ubah</button>
                      <a href="{{route('admin.daftarSiswa')}}" class="btn btn-default">Batal</a>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="parentsId">
                <!-- The timeline -->
            <form class="form-horizontal" method="post" action="{{url('admin/changeParentSiswa')}}">
              {{csrf_field()}}
              <input type="hidden" value="{{$siswa->id}}" name="id">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Name Ayah</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Name Ayah" value="{{$siswa->nama_ayah}}" name="nama_ayah" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Pekerjaan Ayah</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Pekerjaan Ayah" value="{{$siswa->pekerjaan_ayah}}" name="pekerjaan_ayah" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Nama Ibu</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Nama Ibu" value="{{$siswa->nama_ibu}}" name="nama_ibu" required>
                    </div>
                  </div>
                   <div class="form-group">
                    <label class="col-sm-2 control-label">Pekerjaan Ibu</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Pekerjaan Ibu" value="{{$siswa->pekerjaan_ibu}}" name="pekerjaan_ibu" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">No. Telp Orang Tua</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="No. Telp Orang Tua" value="{{$siswa->no_ortu}}" name="no_ortu" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label  class="col-sm-2 control-label">Alamat Orang Tua</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Alamat Orang Tua" value="{{$siswa->alamat_ortu}}" name="alamat_ortu" required>
                    </div>
                  </div>
                   <div class="form-group">
                    <label  class="col-sm-2 control-label">Nama Wali</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Nama Wali" value="{{$siswa->nama_wali}}" name="nama_wali" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label  class="col-sm-2 control-label">Pekerjaan Wali</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Pekerjaan Wali" value="{{$siswa->pekerjaan_wali}}" name="pekerjaan_wali" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label  class="col-sm-2 control-label">Alamat Wali</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Alamat Wali" value="{{$siswa->alamat_wali}}" name="alamat_wali" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label  class="col-sm-2 control-label">No. Telp Wali</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="No. Telp Wali" value="{{$siswa->no_wali}}" name="no_wali" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-warning">Ubah</button>
                      <a href="{{route('admin.daftarSiswa')}}" class="btn btn-default">Batal</a>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>

@endsection