
  <!-- Default panel contents -->
  <h1>Bill Payees added On Your Accounts:</h1>
  <a class="btn btn-success" href="payee/create">Add A New Payee</a>
  @foreach ($payees as $payee)
    <!-- Table -->
    <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Creation Date</th>
              <th>Option</th>
            </tr>
          </thead>
          <tbody>
            <tr>
                <td>{{$payee->getId()}}</td>
                <td>{{$payee->getBill()->getName()}}</td>
                <td>{{$payee->getCreateTime()->format("Y-m-d")}}</td>
                <td>{{ HTML::link('#', 'Make Payment') }} | {{ HTML::link('#', 'Delete Payee') }}</td>
            </tr>
          </tbody>
    </table>
  @endforeach  