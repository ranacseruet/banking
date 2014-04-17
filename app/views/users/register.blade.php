{{ HTML::style('css/auth.css')}}
{{ HTML::style('css/datepicker.css')}}
{{ HTML::script('js/bootstrap-datepicker.js') }}
{{ Form::open(array('url'=>'users/register', 'class'=>'form-signup')) }}
    <h4 class="form-signup-heading">Register</h4>
 
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <fieldset>
        <legend>Authentication Information</legend>
        {{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email Address')) }}
        {{ Form::text('username', null, array('class'=>'input-block-level', 'placeholder'=>'User Name')) }}
        {{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}
        {{ Form::password('password_confirmation', array('class'=>'input-block-level', 'placeholder'=>'Confirm Password')) }}
    </fieldset>
    <br/>
    <fieldset>
        <legend>Personal Information</legend>
        {{ Form::text('first_name', null, array('class'=>'input-block-level', 'placeholder'=>'First Name')) }}
        {{ Form::text('last_name', null, array('class'=>'input-block-level', 'placeholder'=>'Last Name')) }}
        {{ Form::text('birth_date', null, array('class'=>'input-block-level', 'id' =>'birth_date', 'placeholder'=>'Birth Date')) }}
        {{ Form::text('address', null, array('class'=>'input-block-level', 'placeholder'=> 'Address')) }}
        {{ Form::text('phone', null, array('class'=>'input-block-level', 'placeholder'=> 'Phone')) }}
    </fieldset>
 
    {{ Form::submit('Register', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}
<script type="text/javascript">
    $('#birth_date').datepicker();
</script>