
@extends('layouts.default')

@section('content')

<div class="row">
  <div class="container pageH">
      <br/>

    <div class="col-md-row">
      <div class="same-H">
        <div class="">
              <div class="well White div-change ">
                    <div class="row">
                        <br/>
                        <div class="text-center">
                            <span class=""><i class="fa fa-arrow-left blueC"></i> {{link_to_route('users.channel', 'Channel Home')}}</span>
                            &nbsp;&nbsp;|&nbsp;&nbsp;
                            <span class="active">{{link_to_route('users.edit.channel', 'Update Profile', null)}}</span>
                            &nbsp;&nbsp;|&nbsp;&nbsp;
                            <span>{{ link_to_route('users.change-password', 'Change Password', null) }}</span>
                            &nbsp;&nbsp;|&nbsp;&nbsp;
                            <span class=""><b>{{ link_to_route('users.change-email', 'Change Email', null) }}</b></span>
                        </div>
                        <br/>
                        <div class="col-md-12 white">
                          <div class=""> 
                                <h3 class="orangeC text-center">-Your new email will be your primary contact-</h3>
                                <div class="well2">
  	                                {{Form::open(array('route' => 'users.post.change-email'))}}
                										{{Form::label('email', '*Email: ')}}
                										{{Form::text('email', null, array('placeholder' => 'Current Email Address'))}}
                                    <span class="inputError">
                										  {{$errors->first('email')}}
                                    </span>
                										<br/><br/>
                										{{Form::label('newEmail', '*New Email: ')}}
                										{{Form::text('newEmail', null, array('placeholder' => 'New Email Address'))}}
                                    <span class="inputError">
                										  {{$errors->first('newEmail')}}
                                    </span>
                										<br/><br/>
                										{{Form::label('password', '*Password: ')}}
                										{{Form::password('password', null, array('placeholder' => 'Password'))}}
                                    <span class="inputError">
                										  {{$errors->first('password')}}
                                    </span>
                										<br/><br/>
                										{{Form::label('confirmPassword', '*Confirm Password: ')}}
                										{{Form::password('confirmPassword', null, array('placeholder' => 'Confirm Password'))}}
                                    <span class="inputError">
                										  {{$errors->first('confirmPassword')}}
                                    </span>
                										<br/><br/>
                										<div class="text-right">
                											{{Form::submit('Submit',array('class' => 'btn btn-info'))}}
                										</div>
                									{{Form::close()}}
                							    </div>

                              </div>
                          </div><!--/.tabContent-->
                      </div><!--/.tabbable tabs-left-->
                  </div><!--/.row-->
              </div><!--/.well-->
            </div>
          </div><!--/.wrapperAccount-->
          <br/>
      </div><!--/.col-md-12-->
  </div><!--/.container row-->
</div>

@stop
