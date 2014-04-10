<h1>Open Term Deposit</h1>
<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'payment/term-deposit')) }}

    <div class="form-group">
            {{ Form::label('account', 'From Account') }}
            {{ Form::select('account', $from, Input::old('account'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
            {{ Form::label('term', 'Term Length') }}
            {{ Form::select('term', array("SIX_MONTH"=>"Six Months(1%)","ONE_YEAR"=>"One Year(2%)"), Input::old('account'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
            {{ Form::label('amount', 'Amount') }}
            {{ Form::text('amount', Input::old('amount'), array('class' => 'form-control')) }} (Min: 20 CAD)
    </div>
    {{ Form::submit('Make The Payment!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

