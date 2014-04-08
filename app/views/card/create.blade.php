{{ HTML::style('css/datepicker.css')}}
{{ HTML::script('js/bootstrap-datepicker.js') }}

<h1>Add Card</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'account/processaccount')) }}

	<div class="form-group">
		{{ Form::label('account_no', 'Account No.') }}
		{{ Form::text('account_no',  Input::old('account_no'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('type', 'Account Type') }}
		{{ Form::select('type', $type, Input::old('type'), array('class' => 'form-control')) }}
	</div>

     <div class="form-group">
		{{ Form::label('interest_rate', 'Interest Rate %') }}
		{{ Form::text('interest_rate', Input::old('interest_rate'), array('class' => 'form-control')) }}
	 </div>
     <input type="hidden" name='user_id' value="{{$user_id}}" />

	{{ Form::submit('Add Card', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

