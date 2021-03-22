@extends('layouts.admin')
@section('content')
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <!--<h1>
        Dashboard
        <small></small>
      </h1>-->
    </section>
    <!-- Main content -->
    <section class="content">
        <section class="content">
              <div class="row">
                <div class="col-md-9">
                  <div class="box box-primary">
                    <!--<div class="box-header with-border">
                      <h3 class="box-title">Enter Products Details </h3>
                    </div>-->
                    <form role="form" method="POST" action="{{ url('/sendEmail') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="box-body">
                        <div class="form-group">
                          <label for="price">{{ 'Email' }}</label>
                            <input type="hidden" id="site_url" value= "<?php echo URL::to('/');?>">
                            <input required class="form-control" name="name" type="Email" value="" required/>
                        </div>

                       
                    <div class="box-footer">
                        <input class="btn btn-primary" type="submit" value="Send">
                         <a href="{{ url('/products') }}" title="Back"><button class="btn btn-warning btn-sm" type="button"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    </div>        
                    </form>
                  </div> 
                </div>
              </div>
        </section>   
       
    </section>
@endsection
