<h1>Make a New Transfer</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'transfer')) }}

	<div class="form-group">
		{{ Form::label('from', 'From Account') }}
		{{ Form::select('from_account', $from, Input::old('from_account'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('to', 'To Account') }}
		{{ Form::select('to_account', $to, Input::old('to_account'), array('class' => 'form-control')) }}
	</div>

        <div class="form-group">
		{{ Form::label('amount', 'Amount') }}
		{{ Form::text('amount', Input::old('amount'), array('class' => 'form-control')) }}
	</div>

        <div class="form-group">
		{{ Form::label('description', 'Description') }}
		{{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
	</div>

	{{ Form::submit('Make The Payment!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

