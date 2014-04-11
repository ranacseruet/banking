  <!-- Default panel contents -->
<h4>{{ $user->getLastName() }} Accoun's Details</h4>

<br/>
<a class="btn btn-success" href="{{ URL::to('account/withdraw') .'/'. $user->getId() }}">&nbsp;&nbsp;&nbsp;Withdraw&nbsp;&nbsp;&nbsp;</a>

<a style="padding-left: 20px" class="btn btn-success" href="{{ URL::to('account/deposit') .'/'. $user->getId() }}">&nbsp;&nbsp;&nbsp;Deposit&nbsp;&nbsp;&nbsp;</a>
<br/>
<hr/>
<!-- Table -->
@foreach ($accounts as $account)
    <p style="display: inline-block">A/C. {{ HTML::link('account/index/'.$account->getId(), $account->getAccountNo() . '  (' . ucfirst($account->getType()).' Account)', array()) }}
    </p>
  <p style="display: inline-block; float: right">
      <a style="align-self: right" class="btn btn-success" href="{{ URL::to('card/create') .'/'. $account->getId() }}">Add Card</a>
  </p>
    <!-- Table -->
    <table class="table table-bordered">
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
                  <td>{{ strtoupper($transfer->getType())}}</td>
                  <td>{{$transfer->getDescription()}}</td>
                  <td>{{$transfer->getAmount()}}</td>
              </tr>
              @endforeach
          </tbody>
    </table>
  <br/>
@endforeach

