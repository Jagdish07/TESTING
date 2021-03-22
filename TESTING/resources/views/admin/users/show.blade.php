@extends('layouts.admin')

@section('content')

<section class="content-header">
  <h1> User Management</h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">View User</h3>
        </div>

         &nbsp; &nbsp;
          <a href="{{ url('/users') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
          <a href="{{ url('/users/' . $user->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
          
          <br/>
          <br/>
          <form role="form" method="POST" action="{{ url('user/' . $user->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
            <div class="box-body">
              <?php if(!empty())?>
              <div class="form-group">
                <label for="exampleInputEmail1" >{{ 'Email' }}</label>
                  <input class="form-control" required name="email" type="email" id="email" value="<?php echo (!empty($user->email))?$user->email:'';?>" <?php echo (!empty($user->email))?'disabled':'';?>>
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
              </div>
              <div class="form-group">
                <label for="price">{{ 'Username' }}</label>
                 <input required class="form-control" name="username" type="text" id="username" value="<?php echo (!empty($user->username))?$user->username:'';?>" >
                {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
              </div>
              <div class="form-group">
                <label for="price">{{ 'Phone Number' }}</label>
                  <input required class="form-control" name="phone_number" type="number" id="phone_number" value="<?php echo (!empty($user->phone_number))?$user->phone_number:'';?>" >
                  {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
              </div>
              <div class="form-group">
                <label for="price">{{ 'Address' }}</label>
                  <input required class="form-control" name="address" type="text" id="address" value="<?php echo (!empty($user->address))?$user->address:'';?>" >
                  {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
              </div>
              <div class="form-group">
                <label for="dob">{{ 'Brand' }}</label>
                  <input class="form-control" name="brand" type="text" id="brand" value="<?php echo (!empty($user->brand))?$user->brand:'';?>" required>
                  {!! $errors->first('brand', '<p class="help-block">:message</p>') !!}
              </div>
              <div class="form-group">
                  <label for="price">{{ 'CPF Number' }}</label>
                   <input class="form-control" name="cpf_number" type="text" id="cpf_number" value="<?php echo (!empty($user->cpf_number))?$user->cpf_number:'';?>" <?php echo (empty($user->cpf_number))?'required':'';?>>
                  {!! $errors->first('cpf_number', '<p class="help-block">:message</p>') !!}
              </div> 
              <?php if(!empty($user->profile_pic)){?>
                <img src="{{ URL::asset('public/images/users/'.$user->profile_pic) }}" height="50px;" width="50px;" class="uploaded_image">
              <?php }?>
              <div class="form-group">
                <label for="price">{{ 'Profile Pic' }}</label>
                  <input type="file" id="showImage" name="profile_pic" class="form-control addImage">
                  <img src="" class="showImage" height="50px;" width="50px;">
              </div> 
            </div>
            <div class="box-footer">
              <input class="btn btn-primary" type="submit" value="<?php echo (!empty($submitButtonText)?$submitButtonText:'Save')?>">
              <a href="{{ url('/admin/users') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
            </div>  
          </form>
      </div>
      <!-- /.box -->  
    </div>
    <!--/.col (left) -->
  </div>
  <!-- /.row -->
</section>   
@endsection
