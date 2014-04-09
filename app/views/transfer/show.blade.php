
  <!-- Default panel contents -->
  <h1>Transactions made On Your Account:</h1>
  <a class="btn btn-success" href="transfer/create">Make A New Transfer</a>
    <h2>Account: {{ $account->getAccountNo() }} ({{ $account->getType() }})</h2>
    <!-- Table -->
    <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Transaction Date</th>
              <th>Transfer Type</th>
              <th>Summary</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($account->getTransactions() as $transfer)
              <tr>
                  <td>{{$transfer->getId()}}</td>
                  <td>{{$transfer->getCreateTime()->format("Y-m-d H:i:s")}}</td>
                  <td>{{$transfer->getType()}}</td>
                  <td>{{$transfer->getDescription()}}</td>
                  <td>{{$transfer->getAmount()}}</td>
              </tr>
              @endforeach
          </tbody>
    </table> 