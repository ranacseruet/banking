
  <!-- Default panel contents -->
  <h3>Transactions Summary</h3>
  <p>
      Only latest 3 transactions are shown. see individual account details via link for complete details of an account.
  </p>
  <a class="btn btn-success" href="{{URL::to('transfer/create')}}">New Transaction</a>
  <a class="btn btn-success" href="{{URL::to('transfer/wire/edit')}}">New Wire Transfer</a>
  <br/>
  @foreach ($accounts as $account)
  <h5><strong>A/C. {{ HTML::link('account/index/'.$account->getId(), $account->getAccountNo(), array()) }}  ({{ ucfirst($account->getType()) }} Account)</strong></h5>
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