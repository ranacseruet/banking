<h1>Apply For Bank Account</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'account/processcreateaccountbyuser')) }}

	<div class="form-group">
		{{ Form::label('account_no', 'Account No.') }}
		{{ Form::text('account_no',  Input::old('account_no', $account_no), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('type', 'Account Type') }}
		{{ Form::select('type', $type, Input::old('type'), array('class' => 'form-control', 'id'=>'type')) }}
	</div>

     <input type="hidden" name='user_id' value="{{$user_id}}" />

	{{ Form::submit('Apply', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

