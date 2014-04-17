<h3>Change Password</h3>
<hr/>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'users/processchangepassword')) }}

	<div class="form-group">
		{{ Form::label('old_password', 'Previous Password') }}
		{{ Form::password('old_password',  array('class' => 'form-control')) }}
	</div>

    <br/>
    <div class="form-group">
		{{ Form::label('password', 'New Password') }}
		{{ Form::password('password',  array('class' => 'form-control')) }}
	</div>


    <div class="form-group">
		{{ Form::label('password_confirmation', 'Confirmed Password') }}
		{{ Form::password('password_confirmation',  array('class' => 'form-control', 'id' => 'password_confirmation')) }}
	</div>

     <input type="hidden" name='user_id' value="{{$user_id}}" />

	{{ Form::submit('Update Password', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}