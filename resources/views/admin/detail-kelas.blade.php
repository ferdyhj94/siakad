@extends('layouts.admin')
@section('titlePageAdmin','Detail Kelas - Sistem Informasi Akademik ')
@section('content')

 <section class="content-header">
      <h1>
        Profil Kelas
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('dashboardAdmin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('admin.daftarKelas')}}">Daftar Kelas</a></li>
        <li class="active">Detail Kelas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#personalId" data-toggle="tab">Data Personal</a></li>            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="personalId">
    <form class="form-horizontal" method="post" action="{{url('admin/changeKelas')}}">
      {{csrf_field()}}
      <input type="hidden" value="{{$kelas->id}}" name="id">
               <div class="form-group">
                    <label  class="col-sm-2 control-label">Kode Kelas</label>

                    <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Kode Kelas" name="kode_kelas" value="{{$kelas->kode_kelas}}" required>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Guru Pengajar</label>

                    <div class="col-sm-10">
                 <select class="form-control" name="wali_kelas">
                    @foreach($guru as $data)             
                    <option value="{{$data->id}}">{{$data->nama}}</option>
                    @endforeach
                  </select> 
                     </div>
                  </div>

                   <div class="form-group">
                    <label class="col-sm-2 control-label">Jumlah Siswa</label>

                    <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Jumlah Siswa" name="jml_siswa" value="{{$kelas->jml_siswa}}" required>                    </div>
                  </div>
                      <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-warning">Ubah</button>
                      <a href="{{route('admin.daftarKelas')}}" class="btn btn-default">Batal</a>
                    </div>
                  </div>
                </form>
              </div>
          <!-- /.nav-tabs-custom -->
        </form>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
     </div>
        <!-- /.col -->
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