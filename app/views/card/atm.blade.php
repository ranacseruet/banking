{{ HTML::style('css/auth.css')}}
<br>
<br>
<br>
<br>

{{ Form::open(array('url'=>'card/processatm', 'class'=>'form-signin')) }}
	<h1 align="center" class="form-signin-heading">ATM Machine</h1>
        <br/>
        <br/>
        <div class="form-group">
            {{ Form::text('card_no', null, array('class'=>'input-block-level form-control', 'placeholder'=>'Your Card No.')) }}
            {{ Form::password('pin_no', array('class'=>'input-block-level form-control', 'placeholder'=>'Your Four Digit Pin')) }}
	    </div>
        <br/>
        <div class="form-group">
            {{ Form::text('amount', null, array('class'=>'input-block-level form-control', 'placeholder'=>'Amount')) }}
        </div>
        <br/>
        <div class="form-group">
            {{ Form::submit('Withdraw', array('class'=>'btn btn-large btn-primary btn-block'))}}
        </div>
{{ Form::close() }}