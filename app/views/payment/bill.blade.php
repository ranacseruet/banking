<h1>Pay Bill</h1>
<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'payment/bill')) }}

    <div class="form-group">
            {{ Form::label('account', 'From Account') }}
            {{ Form::select('account', $from, Input::old('account'), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
            {{ Form::label('payee', 'To Payee') }}
            {{ Form::select('payee', $to, Input::old('payee'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
            {{ Form::label('amount', 'Amount') }}
            {{ Form::text('amount', Input::old('amount'), array('class' => 'form-control')) }}
    </div>
    {{ Form::submit('Make The Payment!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

