<h1>Make a New Wire Transfer</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'transfer/wire')) }}
        {{ Form::hidden('_method', 'PUT') }}

	<div class="form-group">
		{{ Form::label('from', 'From Account') }}
		{{ Form::select('from_account', $from, Input::old('from_account'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('to', 'To Account No') }}
		{{ Form::text('to_account', Input::old('to_account'), array('class' => 'form-control')) }}
	</div>

        <div class="form-group">
		{{ Form::label('name', 'Account Holder Name') }}
		{{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
	</div>
        
        <div class="form-group">
		{{ Form::label('bank', 'Bank') }}
		{{ Form::text('bank', Input::old('bank'), array('class' => 'form-control')) }}
	</div>
        
        <div class="form-group">
		{{ Form::label('address', 'Address') }}
		{{ Form::text('address', Input::old('address'), array('class' => 'form-control')) }}
	</div>

        <div class="form-group">
		{{ Form::label('amount', 'Amount') }}
		{{ Form::text('amount', Input::old('amount'), array('class' => 'form-control')) }}
	</div>

	{{ Form::submit('Make The Payment!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

