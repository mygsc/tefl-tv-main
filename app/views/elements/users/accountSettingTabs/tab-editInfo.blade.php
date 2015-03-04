<div class="col-md-10"> 
        <div class="col-md-12">
            <span>
                <label>Account Status:</label>
                <select>
                    <option>Activate</option>
                    <option>Deactivate</option>
                </select>   
                <small>(*When account is deactivate, your channel will not be searchable)</small>
            </span>

            <br/><br/>

            <span>
                <input type="checkbox"> <label>Mark All</label>&nbsp;
                <small>(*Mark fields with check if you want to display your information in public)</small>
            </span>
            <br/><br/>
        </div>
        

        <div class="col-md-3">
            <label><small>Click image to change</small></label>
            {{ Form::open(array('route' => ['users.post.edit.channel', Auth::User()->channel_name]))}}
            {{HTML::image('img/user/'.Auth::User()->id.'.jpg', 'alt', array('data-toggle' => 'modal', 'data-target' => '#display_picture', 'class' => 'pic-Dp'))}}
            <br/>
        </div>

        <div class="col-md-9">
            {{ Form::checkbox('name', 'value', false) }} 
            {{Form::label('interests', 'Interests: ')}}
            {{Form::textarea('interests',$userChannel->interests, array('placeholder' => 'Interests'))}}
       </div>

        <div class="col-md-6 ">
            {{ Form::checkbox('name', 'value', false) }} 
            {{Form::label('first_name', 'Firstname: ')}} {{ Form::text('first_name',$userChannel->first_name, array('placeholder' => 'Firstname'))}}
            {{$errors->first('first_name')}}
        </div>

        <div class="col-md-6">
            {{ Form::checkbox('name', 'value', false) }} 
            {{Form::label('last_name', 'Lastname: ')}} {{ Form::text('last_name', $userChannel->last_name, array('placeholder' => 'Lastname'))}}
            {{$errors->first('last_name')}}
        </div>

        <div class="col-md-6 ">
            {{ Form::checkbox('name', 'value', false) }} 
            {{Form::label('website', 'Website: ')}} {{Form::text('website', Auth::User()->website, array('placeholder' => 'Website'))}}
        </div>

        <div class="col-md-6 ">
            {{ Form::checkbox('name', 'value', false) }} 
            {{Form::label('organization', 'Organization: ')}} {{Form::text('organization', Auth::User()->organization, array('placeholder' => 'website'))}}
            {{$errors->first('organization')}}
        </div>

        <div class="col-md-6 ">
            {{ Form::checkbox('name', 'value', false) }} 
           {{Form::label('work', 'Work: ')}} {{Form::text('work', $userChannel->work, array('placeholder' => 'Work'))}}
        </div>

        <div class="col-md-6 ">
            {{ Form::checkbox('name', 'value', false) }} 
            {{ Form::label('contact_number', 'Contact Number: ')}} {{ Form::text('contact_number', $userChannel->contact_number, array('placeholder' => 'Contact Number'))}}
            {{$errors->first('contact_number')}}
        </div>

        <div class="col-md-6 ">
            {{ Form::checkbox('name', 'value', false) }} 
            {{ Form::label('address', 'Address: ')}} {{ Form::text('address', $userChannel->address, array('placeholder' => 'address'))}}
            {{$errors->first('address')}}
        </div>

        <div class="col-md-6 ">
            {{ Form::checkbox('name', 'value', false) }} 
            {{Form::label('birthdate', 'Birthdate: ')}} {{Form::text('birthdate', $userChannel->birthdate, array('placeholder' => 'Birthdate'))}}
            {{$errors->first('birthdate')}}
        </div>

        <div class="col-md-6 ">
            {{ Form::checkbox('name', 'value', false) }} 
            {{Form::label('zip_code', 'Zip Code: ')}} {{Form::text('zip_code', $userChannel->zip_code, array('placeholder' => 'Zip Code'))}}
        </div>
        <div class="col-md-6 ">
            {{ Form::checkbox('name', 'value', false) }} 
            {{Form::label('zip_code', 'Zip Code: ')}} {{Form::text('zip_code', $userChannel->zip_code, array('placeholder' => 'Zip Code'))}}
        </div>

        <div class="text-right">
           {{Form::submit('Save Changes', array('class' => 'btn btn-info'))}}
        </div>
    {{ Form::close()}}
</div>