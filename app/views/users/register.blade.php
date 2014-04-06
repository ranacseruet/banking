{{ Form::open(array('url'=>'users/register', 'class'=>'form-signup')) }}
    <h2 class="form-signup-heading">Please Register</h2>
 
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <fieldset>
        {{ Form::text('username', null, array('class'=>'input-block-level', 'placeholder'=>'User Name')) }}
        {{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}
        {{ Form::password('password_confirmation', array('class'=>'input-block-level', 'placeholder'=>'Confirm Password')) }}
    </fieldset>
    <br/>
    <fieldset>
        {{ Form::text('first_name', null, array('class'=>'input-block-level', 'placeholder'=>'First Name')) }}
        {{ Form::text('last_name', null, array('class'=>'input-block-level', 'placeholder'=>'Last Name')) }}
        {{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email Address')) }}
    </fieldset>

 
    {{ Form::submit('Register', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}