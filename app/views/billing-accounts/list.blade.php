
  <!-- Default panel contents -->
  <h1>Billing Accounts:</h1>
  <a class="btn btn-success" href="billing-accounts/create">Add A New Billing Account</a>
    <!-- Table -->
    <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Creation Date</th>
              <th>Associated Account No</th>
              <th>Options</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($accounts as $account)
              <tr>
                  <td>{{$account->getId()}}</td>
                  <td>{{$account->getName()}}</td>
                  <td>{{$account->getCreateTime()->format("Y-m-d")}}</td>
                  <td>{{$account->getAccount()->getAccountNo()}}</td>
                  <td>
                      {{ Form::open(array('url' => 'billing-accounts/'.$account->getId())) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete this Billing', array('class' => 'btn btn-danger')) }}
                      {{ Form::close() }}
                  </td>
              </tr>
              @endforeach
          </tbody>
    </table>