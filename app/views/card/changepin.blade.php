<h1>Change Pin</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'card/processchangepin')) }}

	<div class="form-group">
		{{ Form::label('old_pin_no', 'Previous Pin') }}
		{{ Form::password('old_pin_no',  array('class' => 'form-control')) }}
	</div>

    <br/>
    <div class="form-group">
		{{ Form::label('pin_no', 'Pin') }}
		{{ Form::password('pin_no',  array('class' => 'form-control')) }}
	</div>


    <div class="form-group">
		{{ Form::label('pin_no_confirmation', 'Confirmed Pin') }}
		{{ Form::password('pin_no_confirmation',  array('class' => 'form-control', 'id' => 'pin_no_confirmation')) }}
	</div>

     <input type="hidden" name='card_id' value="{{$card_id}}" />

	{{ Form::submit('Update', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}