@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <!--<h1>
        Users Management
      </h1>-->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            @if ($message = Session::get('flash_message'))
              <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                  <strong>{{ $message }}</strong>
              </div>
            @endif
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Email</th>
                   
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 1;?>
                  @foreach($result as $users)
                    <tr>
                      <td>{{ $i }}</td>
                      <td>{{ $users['email'] }}%</td>
                      <td>
                        <a href="url('/updateStatus/')<?php echo $users['id']. '/'. $users['status'];?>">  <?php ($users['status']  == 1)? 'Enable' : 'Disabled' ?></a>

                        <a href="url('/users/edit/')<?php echo $users['id'];?>">  Update Deatials</a>

                        <form method="POST" action="<?php echo url('/');?>/users/<?php echo $users['id'];?>" accept-charset="UTF-8" style="display:inline">
                          {{ method_field('DELETE') }}
                          {{ csrf_field() }}
                          <button type="submit" class="btn btn-danger btn-sm" title="Delete User" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </form>
                      </td>
                    </tr>
                    <?php $i++;?>
                 @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection



<script type="text/javascript">
  function banuserid(id){
    var url = "<?php echo URL::to('/');?>";
    $.ajax({
      type:"POST",
      url: url+"/banauser",
      data:{'id':id,'_token':$('meta[name="csrf-token"]').attr('content')},
      dataType: "json",
      success:function(data) {
        $('.approve_user-'+id).show();
        $('.ban_user-'+id).hide();
      }
    });
  }


  function addPoints(id){
      $('.give_add_points').attr('disabled',true);
    var url = "<?php echo URL::to('/');?>";
    $.ajax({
      type:"POST",
      url: url+"/addmanualpoints",
      data:{'id':id,'_token':$('meta[name="csrf-token"]').attr('content')},
      dataType: "json",
      success:function(data) {

      }
    });
  }

  $(document).ready(function() {
      $('#example1').DataTable({
          dom: 'Bfrtip',
          buttons: [
              'csv'
          ]
      });
  });
</script>

