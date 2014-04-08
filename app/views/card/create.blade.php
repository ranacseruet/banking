{{ HTML::style('css/datepicker.css')}}
{{ HTML::script('js/bootstrap-datepicker.js') }}

<h1>Add Card</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'card/processcreate')) }}

	<div class="form-group">
		{{ Form::label('card_no', 'Card No.') }}
		{{ Form::text('card_no',  Input::old('card_no'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('type', 'Card Type') }}
		{{ Form::select('type', $type, Input::old('type'), array('class' => 'form-control')) }}
	</div>

    <div class="form-group">
		{{ Form::label('pin_no', 'Pin') }}
		{{ Form::password('pin_no',  array('class' => 'form-control')) }}
	</div>


    <div class="form-group">
		{{ Form::label('pin_confirmation', 'Confirmed Pin') }}
		{{ Form::password('pin_confirmation',  array('class' => 'form-control', 'id' => 'pin_confirmation')) }}
	</div>

     <div class="form-group">
		{{ Form::label('issue_date', 'Issue Date') }}
		{{ Form::text('issue_date', Input::old('issue_date'), array('class' => 'form-control','id' => 'issue_date')) }}
	 </div>

    <div class="form-group">
		{{ Form::label('expire_date', 'Expire Date') }}
		{{ Form::text('expire_date', Input::old('expire_date'), array('class' => 'form-control','id' => 'expire_date')) }}
	 </div>
     <input type="hidden" name='account_id' value="{{$account_id}}" />

	{{ Form::submit('Add Card', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
<script type="text/javascript">
    $('#issue_date').datepicker();
    $('#expire_date').datepicker();
</script>
