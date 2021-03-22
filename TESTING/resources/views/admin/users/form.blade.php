<div class="box-body">
    <div class="form-group">
        <label for="exampleInputEmail1" >{{ 'Email' }}</label>
          <input class="form-control" required name="email" type="email" id="email" value="<?php echo (!empty($user->email))?$user->email:'';?>" <?php echo (!empty($user->email))?'disabled':'';?>>
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
   
    <?php if(!empty($user->profile_pic)){
        $profile_count = explode('/',$user->profile_pic);
        if($profile_count == 1){?>
            <img src="{{ URL::asset('public/images/users/'.$user->profile_pic) }}" height="50px;" width="50px;" class="uploaded_image">
        <?php } else{?>
            <img src="<?php echo $user->profile_pic;?>" height="50px;" width="50px;" class="uploaded_image">
        <?php }?>
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