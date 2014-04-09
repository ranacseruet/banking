
  <!-- Default panel contents -->
  <h1>Bill Payees added On Your Accounts:</h1>
  <a class="btn btn-success" href="payee/create">Add A New Payee</a>
    <!-- Table -->
    <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Account No</th>
              <th>Creation Date</th>
              <th>Option</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($payees as $payee)
            <tr>
                <td>{{$payee->getId()}}</td>
                <td>{{$payee->getBill()->getName()}}</td>
                <td>{{$payee->getAccountNo()}}</td>
                <td>{{$payee->getCreateTime()->format("Y-m-d")}}</td>
                <td>
                    {{ Form::open(array('url' => 'payee/'.$payee->getId())) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ HTML::link('payment/bill', 'Make A Payment', array('class' => 'btn btn-success')) }} 
                            {{ Form::submit('Delete this Payee', array('class' => 'btn btn-danger')) }}
                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach 
          </tbody>
    </table> 