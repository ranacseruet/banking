
  <!-- Default panel contents -->
  <h3>Investment Summary</h3>
  {{ HTML::link('investment/create', "New Investment", array('class' => 'btn btn-primary') ) }}
  <br/>
    <!-- Table -->
    <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Transaction Date</th>
              <th>Term Type</th>
              <th>Interest Rate</th>
              <th>Amount</th>
              <th>Option</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($accounts as $index => $account)
              @if(!$account->getIsActive())
                {{ '';continue }}
              @endif
              <tr>
                  <td>{{$account->getId()}}</td>
                  <td>{{$account->getCreateTime()->format("Y-m-d H:i:s")}}</td>
                  <td>{{$account->getTermType()}}</td>
                  <td>{{$account->getInterestRate()}}</td>
                  <td>{{$account->getAmount()}}</td>
                  <td>{{ HTML::link('investment/'.$account->getId(), "Redeem/Details", array('class' => 'btn btn-success') ) }}</td>
              </tr>
              @endforeach
          </tbody>
    </table>