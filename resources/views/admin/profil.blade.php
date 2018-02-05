@extends('layouts.admin')
@section('titlePageAdmin','Detail Admin - Sistem Informasi Akademik ')
@section('content')

 <section class="content-header">
      <h1>
        Profil Admin
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('dashboardAdmin')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Profil Admin</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
                @if(!file_exists($admin->url_photo)) <img class="profile-user-img img-responsive img-circle" src="{{asset('/dist/img/user-unknown.png')}}" alt="Foto Admin"> 
                @else <img class="profile-user-img img-responsive img-circle" src="{{$admin->url_photo}}" alt="Foto Profil Admin"> 
                @endif
              <h3 class="profile-username text-center">{{$admin->name}}</h3>

              <p class="text-muted text-center">{{$admin->username}}</p>

              <ul class="list-group list-group-unbordered">
                
                
                <li class="list-group-item">
                  <b>Status</b> <a class="pull-right"><label class="label label-success">{{$admin->user_role}}</label></a>
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
              <li><a href="#passAdmin" data-toggle="tab">Data Password</a></li>
            </ul>
            <div class="tab-content">
          <!-- /.nav-tabs-custom -->
              <div class="active tab-pane" id="personalId">
                     @if(Session::has('message'))
<div class="alert alert-success" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>{{Session::get('message')}}</div>
@endif
    <form class="form-horizontal" method="post" action="{{url('admin/changeProfil')}}">
      {{csrf_field()}}  
                   <div class="form-group">
                    <label  class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Nama" name="name" value="{{$admin->name}}" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label  class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Username" name="username" value="{{$admin->username}}" required>
                   </div>
                  </div>
                   <div class="form-group">
                    <label  class="col-sm-2 control-label">E-Mail</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="E-Mail" name="email" value="{{$admin->email}}" required>
                   </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Hak Akses</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="hak_akses" value="{{$admin->user_role}}"  readonly>
                    </div>
                    </div>
                      <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Ubah</button>
                    </div>
                  </div>
                </form>
        
        </div>
        <!-- tab personal-->
                      <div class="tab-pane" id="passAdmin">
                         @if(Session::has('messagePass'))
<div class="alert alert-success" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>{{Session::get('messagePass')}}</div>
@endif
    <form class="form-horizontal" method="post" action="{{url('admin/changePasswordAdmin')}}">
      {{csrf_field()}}
                   <div class="form-group">
                    <label  class="col-sm-2 control-label">Password Baru</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" placeholder="Password Baru" name="password" required>
                    </div>
                  </div>
                 <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Ubah</button>
                    </div>
                  </div>
                </form>
        <!-- tab password -->
        </div>
      </div>
      <!-- /.tab pane -->
           </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    
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