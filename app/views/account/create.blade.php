<h1>Create Bank Account</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'account/processaccount')) }}

	<div class="form-group">
		{{ Form::label('account_no', 'Account No.') }}
		{{ Form::text('account_no',  Input::old('account_no', $account_no), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('type', 'Account Type') }}
		{{ Form::select('type', $type, Input::old('type'), array('class' => 'form-control', 'id'=>'type')) }}
	</div>

     <div class="form-group" id="interest_rate_div">
		{{ Form::label('interest_rate', 'Interest Rate %') }}
		{{ Form::text('interest_rate', Input::old('interest_rate'), array('class' => 'form-control')) }}
	 </div>

    <div class="form-group" id = 'amount_div' style="display: none">
		{{ Form::label('amount', 'Fixed Amount') }}
		{{ Form::text('amount', Input::old('amount'), array('class' => 'form-control')) }}
	 </div>
     <input type="hidden" name='user_id' value="{{$user_id}}" />

	{{ Form::submit('Create', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

<script type="text/javascript">
    $('#type').on('change', function(){
        var type = $('#type option:selected').val();

        if(type == 'checking' || type == 'credit_card') {
            $('#interest_rate_div').hide();
        } else {
            $('#interest_rate_div').show();
        }

        if(type == 'investment') {
            $('#amount_div').show();
        } else {
            $('#amount_div').hide();
        }
    });
</script>