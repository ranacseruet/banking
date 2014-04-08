<h1>Make a New Transfer</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'payee')) }}

	<div class="form-group">
		{{ Form::label('bill', 'Bill Account') }}
		{{ Form::select('bill', $bills, Input::old('bill'), array('class' => 'form-control')) }}
	</div>

        <div class="form-group">
		{{ Form::label('accountNo', 'Account No') }}
		{{ Form::text('accountNo', Input::old('accountNo'), array('class' => 'form-control')) }}
	</div>
	
	{{ Form::submit('Add The Payee!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

