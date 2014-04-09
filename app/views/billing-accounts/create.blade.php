<h1>Create a New Billing Account</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'billing-accounts')) }}

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('account', 'Associated Account') }}
		{{ Form::select('account', $accounts, Input::old('account'), array('class' => 'form-control')) }}
	</div>
	
	{{ Form::submit('Add The Payee!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

