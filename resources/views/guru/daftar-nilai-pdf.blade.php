<title>Daftar Nilai {{$kelas->kode_kelas}}</title>
<style type="text/css">
table,td,th{
   border: 1px solid black;
   border-collapse: collapse;
},
th, td {
    padding: 5px;
    text-align: left;    
}
</style>
<center><h1>SMP Harapan Bangsa</h1></center>
      <div class="row"> 
        <div class="col-lg-12">
          <div class="box">
            <div class="box-header with-border">
           <center><h3 class="box-title">Daftar Nilai {{$kelas->kode_kelas}}</h3></center>
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
          </div>
                <!-- /.col -->
               <table>
                <thead>
                <tr>
                  <th>No.</th>
                  <th>NISN</th>
                  <th>Nama</th>
                  <th>Nilai</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; ?>
                  @forelse($data as $datas)
               <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $datas->nisn; ?></td>
                <td><?php echo $datas->nama; ?></td>
                <td><?php echo $datas->nilai?></td>
               </tr>
               @empty
               <tr>
                <td><span class="alert alert-danger">Kosong</span></td>
               </tr>
               @endforelse
                </tbody>
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
