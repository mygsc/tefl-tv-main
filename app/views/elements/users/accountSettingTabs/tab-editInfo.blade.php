<div class="col-md-10 textbox-layout"> 
   

        <div class="col-md-3">
            <label><small>Click image to change</small></label>
            {{ Form::open(array('route' => ['users.post.edit.channel', Auth::User()->channel_name]))}}
            {{HTML::image('img/user/'.Auth::User()->id.'.jpg', 'alt', array('data-toggle' => 'modal', 'data-target' => '#display_picture', 'class' => 'pic-Dp'))}}
            <br/>
        </div>

        <div class="col-md-9">

            {{Form::label('interests', 'Interests: ')}}
            {{Form::textarea('interests',$userChannel->interests, array('placeholder' => 'Interests', 'style' => 'min-height:230px;'))}}
       </div>
       <br/>
            <div class="col-md-12">
            <span>
                <br/>
                <select class="form-control autoW">    
                    <option>Account Privacy</option>
                    <option>Activate</option>
                    <option>Deactivate</option>
                </select>
                <!--show this when deactivate is selected-->
                  <small class="notes">Fields with asterisk (*) are required.</small>
                

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
            {{Form::text('country', $userChannel->country, array('placeholder' => 'Country'))}}
        </div>
        <div class="col-md-6 ">
            {{ Form::checkbox('name', 'value', false) }} 
            {{Form::label('zip_code', 'Zip Code: ')}}
            {{Form::text('zip_code', $userChannel->zip_code, array('placeholder' => 'Zip Code'))}}
        </div>

        <div class="text-right">
           {{Form::submit('Save Changes', array('class' => 'btn btn-info'))}}
        </div>
    {{ Form::close()}}
</div>