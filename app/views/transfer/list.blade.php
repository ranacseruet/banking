
  <!-- Default panel contents -->
  <h1>Transactions Summary:</h1>
  <p>
      Only latest 3 transactions are shown. see individual account details via link for complete details of an account.
  </p>
  <a class="btn btn-success" href="transfer/create">New Transaction</a>
  <a class="btn btn-success" href="transfer/wire/edit">New Wire Transfer</a>
  @foreach ($accounts as $account)
  <h3><strong>Account: {{ HTML::link('account/index/'.$account->getId(), $account->getAccountNo(), array()) }} ({{ $account->getType() }})</strong></h3>
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
              @foreach ($account->getTransactions() as $index => $transfer)
              @if($index > 2 )
                {{ ''; continue }}
              @endif
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
  @endforeach  