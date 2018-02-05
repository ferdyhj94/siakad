@extends('layouts.admin') 
@section('titlePageAdmin','Tambah Data Siswa - Sistem Informasi Akademik')
@section('content')

  <section class="content-header">
      <h1>
        Tambah Data Siswa
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('daftarSiswa')}}">Tambah Data Siswa</a></li>
        <li class="active">Tambah Data</li>
      </ol>
    </section>
  @if(Session::has('messageErr'))
<div class="alert alert-danger" role="alert">{{Session::get('messageErr')}}</div>
@endif
    <section class="content">
            <div class="row">
        <!-- left column -->
        <div class="col-md-6">
    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Personal</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{url('admin/addSiswa')}}" method="post" files="true" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label>NISN</label>
                  <input type="text" class="form-control" name="nisn" placeholder="NISN" required>
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                </div>
                <div class="form-group">
                  <label>Jenis Kelamin</label>
                   <select class="form-control" name="jk">
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Tahun Angkatan</label>
                  <input type="text" class="form-control" value="<?php echo date("Y") ?>" name="tahun_angk" placeholder="Tahun Angkatan" required>
                </div>
                <div class="form-group">
                  <label>Agama</label>
                  <input type="text" class="form-control" name="agama" placeholder="Agama" required>
                </div>
                <div class="form-group">
                  <label >Tempat Lahir</label>
                  <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" required>
                </div>
            <div class="form-group">
                <label>Tanggal Lahir</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" name="tanggal_lahir" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask required>
                </div>
                <!-- /.input group -->
              </div>
                <div class="form-group">
                  <label>Anak Ke-</label>
                  <input type="text" class="form-control" name="anak_ke" placeholder="Anak Ke-" required>
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <input type="text" class="form-control" name="status" placeholder="Status" required>
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <input type="text" class="form-control" name="alamat"  placeholder="Alamat" required>
                </div>
                <div class="form-group">
                  <label>Tanggal Masuk</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" name="tanggal_masuk" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask required>
                </div>
                </div>
                <div class="form-group">
                  <label>Kelas</label>
                  <select class="form-control" name="kelas">
                    @foreach($kelas as $data)
                    <option value="<?php echo $data->id?>">{{$data->kode_kelas}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Foto Siswa</label>
                  <input type="file" name="foto">
                  <p class="help-block">Max 300 kb</p>
                </div>
              </div>
               </div>
              </div>
              <!-- /.box-body -->
 <div class="col-md-6">
    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Data Orang Tua</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label >Nama Ayah</label>
                  <input type="text" class="form-control" name="nama_ayah" placeholder="Nama Ayah" required>
                </div>
                <div class="form-group">
                  <label >Pekerjaan Ayah</label>
                  <input type="text" class="form-control" name="pekerjaan_ayah" placeholder="Pekerjaan Ayah" required>
                </div>
                <div class="form-group">
                  <label >Nama Ibu</label>
                  <input type="text" class="form-control" name="nama_ibu"  placeholder="Nama Ibu" required>
                </div>
                <div class="form-group">
                  <label >Pekerjaan Ibu</label>
                  <input type="text" class="form-control" name="pekerjaan_ibu"  placeholder="Pekerjaan Ibu" required>
                </div>
                <div class="form-group">
                  <label >Alamat Orang Tua</label>
                  <input type="text" class="form-control" name="alamat_ortu" placeholder="Alamat Orang Tua" required>
                </div>
                <div class="form-group">
                  <label >No. Telp Orang Tua</label>
                  <input type="text" class="form-control" name="no_ortu" placeholder="No. Telp Orang Tua" required>
                </div>
                <div class="form-group">
                  <label >Nama Wali* </label>
                  <input type="text" class="form-control" name="nama_wali" placeholder="Nama Wali">
                </div>
                <div class="form-group">
                  <label >Pekerjaan Wali*</label>
                  <input type="text" class="form-control" name="pekerjaan_wali"  placeholder="Pekerjaan Wali">
                </div>
                <div class="form-group">
                  <label >Alamat Wali*</label>
                  <input type="text" class="form-control" name="alamat_wali" placeholder="Alamat Wali">
                </div>
                <div class="form-group">
                  <label >No. telp Wali*</label>
                  <input type="text" class="form-control" name="no_wali" placeholder="No. telp Wali">
                </div>
                 <p class="help-block">* ketik strip (-) jika tidak ada</p>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
         </div>  
      </div>
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