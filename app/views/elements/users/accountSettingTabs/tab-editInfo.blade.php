<div class="col-md-10 textbox-layout"> 
        <div class="col-md-3">
            <label><small>Click image to change</small></label>
            {{Form::open(array('route' => ['users.post.edit.channel', Auth::User()->channel_name]))}}            
                @if(file_exists($picture))
                {{HTML::image('img/user/'.Auth::User()->id.'.jpg', 'alt', array('data-toggle' => 'modal', 'data-target' => '#display_picture', 'class' => 'pic-Dp'))}}
                @else
                {{HTML::image('http://www.fm-base.co.uk/forum/attachments/football-manager-2014-manager-stories/618828d1403554937-ups-downs-building-one-default_original_profile_pic.png'. '.jpg', 'alt', array('data-toggle' => 'modal', 'data-target' => '#display_picture', 'class' => 'pic-Dp'))}}
                @endif
            <br/>
        </div>

        <div class="col-md-9">
            {{Form::label('interests', 'Interests: ')}}
            {{Form::textarea('interests',$userChannel->interests, array('placeholder' => 'Interests', 'style' => 'min-height:230px;'))}}
        </div>
        <br/>
        <div class="col-md-12">
            <small class="notes"><b>Notes: </b><br/>
                Deactivate your account if you don't want your channel to be seen by others. All fields with asterisk (*) are required. Check all information you want to show in public.</small>
             <select class="form-control autoW">    
                <option disabled>Account Privacy</option>
                <option>Activate</option>
                <option>Deactivate</option>
            </select>
                <!--show this when deactivate is selected-->
            <br/><br/>
        </div>
        

        <div class="col-md-6 ">
            {{ Form::checkbox('name', 'value', false) }} 
            {{Form::label('first_name', '*Firstname: ')}}
            <span class="inputError">{{$errors->first('first_name')}}</span>
            {{ Form::text('first_name',$userChannel->first_name, array('placeholder' => 'Firstname'))}}
            
        </div>

        <div class="col-md-6">
            {{ Form::checkbox('name', 'value', false) }} 
            {{Form::label('last_name', '*Lastname: ')}}
            <span class="inputError">{{$errors->first('last_name')}}</span>
            {{ Form::text('last_name', $userChannel->last_name, array('placeholder' => 'Lastname'))}}
            
        </div>

        <div class="col-md-6 ">
            {{ Form::checkbox('name', 'value', false) }} 
            {{Form::label('website', 'Website: ')}} 
            {{Form::text('website', Auth::User()->website, array('placeholder' => 'Website'))}}
        </div>

        <div class="col-md-6 ">
            {{ Form::checkbox('name', 'value', false) }} 
            {{Form::label('organization', '*Organization: ')}}
            <span class="inputError">{{$errors->first('organization')}}</span>
            {{Form::text('organization', Auth::User()->organization, array('placeholder' => 'Organization'))}}
            
        </div>

        <div class="col-md-6 ">
            {{ Form::checkbox('name', 'value', false) }} 
           {{Form::label('work', 'Work: ')}}
           {{Form::text('work', $userChannel->work, array('placeholder' => 'Work'))}}
        </div>

        <div class="col-md-6 ">
            {{ Form::checkbox('name', 'value', false) }}  
            {{ Form::label('contact_number', '*Contact Number: ')}}
            <span class="inputError"> {{$errors->first('contact_number')}}</span> 
            {{ Form::text('contact_number', $userChannel->contact_number, array('placeholder' => 'Contact Number'))}}
           
        </div>

        <div class="col-md-6 ">
            {{ Form::checkbox('name', 'value', false) }}
            {{ Form::label('address', '*Address: ')}}
            <span class="inputError">{{$errors->first('address')}}</span>
            {{ Form::text('address', $userChannel->address, array('placeholder' => 'address'))}}
            
        </div>

        <div class="col-md-6 ">
            {{ Form::checkbox('name', 'value', false) }} 
            {{Form::label('birthdate', '*Birthdate: ')}}
            <span class='inputError'>{{$errors->first('birthdate')}}</span>
            {{Form::text('birthdate', $userChannel->birthdate, array('placeholder' => 'Birthdate'))}}
            
        </div>

        <div class="col-md-6 ">
            {{ Form::checkbox('name', 'value', false) }} 
            {{Form::label('country', 'Country: ')}}
            {{Form::text('country', $userChannel->country_id, array('placeholder' => 'Country'))}}
        </div>
        <div class="col-md-6 ">
            {{ Form::checkbox('name', 'value', false) }} 
            {{Form::label('zip_code', 'Zip Code: ')}}
            {{Form::text('zip_code', $userChannel->zip_code, array('placeholder' => 'Zip Code'))}}
        </div>
        @if(empty($userWebsite))   
            <div class="col-md-6">
            {{Form::label('facebook', 'Facebook: ')}}            
            {{Form::text('facebook', null, array('placeholder' => 'Facebook Account'))}}
        </div>
        <div class="col-md-6">
            {{Form::label('twitter', 'Twitter: ')}}
            {{Form::text('twitter', null, array('placeholder' => 'Twitter Account'))}}
        </div>
        <div class="col-md-6">
            {{Form::label('instagram', 'Instagram: ')}}
            {{Form::text('instagram', null, array('placeholder' => 'Instagram Account'))}}
        </div>
        <div class="col-md-6">
            {{Form::label('gmail', 'Gmail: ')}}
            {{Form::text('gmail', null, array('placeholder' => 'Gmail Account'))}}
        </div>
        <div class="col-md-6">
            {{Form::label('others', 'Other Websites: ')}}
            {{Form::text('others', null, array('placeholder' => 'Other Website Accounts'))}}
        </div>
        @else
        <div class="col-md-6">
            {{Form::label('facebook', 'Facebook: ')}}            
            {{Form::text('facebook', $userWebsite->facebook, array('placeholder' => 'Facebook Account'))}}
        </div>
        <div class="col-md-6">
            {{Form::label('twitter', 'Twitter: ')}}
            {{Form::text('twitter', $userWebsite->twitter, array('placeholder' => 'Twitter Account'))}}
        </div>
        <div class="col-md-6">
            {{Form::label('instagram', 'Instagram: ')}}
            {{Form::text('instagram', $userWebsite->instagram, array('placeholder' => 'Instagram Account'))}}
        </div>
        <div class="col-md-6">
            {{Form::label('gmail', 'Gmail: ')}}
            {{Form::text('gmail', $userWebsite->gmail, array('placeholder' => 'Gmail Account'))}}
        </div>
        <div class="col-md-6">
            {{Form::label('others', 'Other Websites: ')}}
            {{Form::text('others', $userWebsite->others, array('placeholder' => 'Other Website Accounts'))}}
        </div>
        @endif

        <div class="text-right col-md-12">
           {{Form::submit('Save Changes', array('class' => 'btn btn-info'))}}
        </div>
    {{ Form::close()}}
</div>

@section('modal')
<!-- Modal -->
<div class="modal fade" id="display_picture" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog black">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          {{Form::open(array('route' => ['users.upload.image', Auth::User()->id], 'files' => 'true'))}}
            {{ Form::file('image', array('id' => 'uploaded_img'))}}

      </div>
      <div class="modal-body">
            <div class="uploaded_img">
                {{HTML::image('img/user/' . Auth::User()->id . '.jpg', 'Nothing to display.', array('id' => 'preview', 'class' => 'center-block'))}}
            </div>

            
            
      </div>
      <div class="modal-footer">
        {{Form::submit("Save", array('class' => 'btn btn-info'))}}
        {{Form::close()}}
        <button type="button" class="btn btn-unSub" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
@stop