  <!-- Default panel contents -->
<h4>{{ $user->getLastName() }} Accoun's Details</h4>

<br/>
<a class="btn btn-success" href="account/withdraw/{{$user->getId()}}">&nbsp;&nbsp;&nbsp;Withdraw&nbsp;&nbsp;&nbsp;</a>

<a style="padding-left: 10px" class="btn btn-success" href="account/deposit/{{$user->getId()}}">&nbsp;&nbsp;&nbsp;Deposit&nbsp;&nbsp;&nbsp;</a>
<br/>
<hr/>
<!-- Table -->
@foreach ($accounts as $account)
    <p>A/C. {{ HTML::link('account/index/'.$account->getId(), $account->getAccountNo() . '  (' . ucfirst($account->getType()).' Account)', array()) }}</p>
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

