@extends('layouts.admin')
@section('titlePageAdmin','Detail Mata Pelajaran - Sistem Informasi Akademik ')
@section('content')

 <section class="content-header">
      <h1>
        Detail Mata Pelajaran
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('dashboardAdmin')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="{{route('daftarMapel')}}">Mapel</a></li>
        <li class="active">Detail Mapel</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#personalId" data-toggle="tab">Data Mata Pelajaran</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="personalId">
    <form class="form-horizontal" method="post" action="{{url('admin/changeMapel')}}">
      {{csrf_field()}}
      <input type="hidden" value="{{$mapel->id}}" name="id">
                  <div class="form-group">
                    <label  class="col-sm-2 control-label">Mata Pelajaran</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Mata Pelajaran" value="{{$mapel->nama_mapel}}" name="nama_mapel" required>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Guru Pengajar</label>

                    <div class="col-sm-10">
                 <select class="form-control" name="id_guru">

                    @foreach($guru as $data)
                    <option placeholder="Pilih Guru..." value="<?php echo $data->id?>">{{$data->nama}}</option>
                    @endforeach
                  </select> 
                     </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Kelas</label>

                    <div class="col-sm-10">
                    <select class="form-control" name="id_kelas">
                    <option disabled>Pilih kelas... </option>                          
                    @foreach($kelas as $class)
                    <option value="{{$class->id}}" placeholder="Pilih Kelas...">{{$class->kode_kelas}}</option>
                    @endforeach
                  </select>   
                    </div>
                  </div>
                   <div class="form-group">
                    <label class="col-sm-2 control-label">KKM</label>

                    <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="KKM" value="<?php echo $mapel->kkm?>" name="kkm" required>            
                     </div>
                  </div>
             

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
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