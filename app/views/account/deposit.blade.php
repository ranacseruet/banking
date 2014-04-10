<h1>Deposit</h1>
<hr/>
<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'account/processdeposit')) }}

	<div class="form-group">
		{{ Form::label('account_no', 'Account No.') }}
		{{ Form::select('account_no', $userAccounts, Input::old('account_no'), array('class' => 'form-control')) }}
	</div>

     <div class="form-group">
		{{ Form::label('amount', 'Amount') }}
		{{ Form::text('amount', Input::old('amount'), array('class' => 'form-control')) }}
	 </div>
	{{ Form::submit('Deposit', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

