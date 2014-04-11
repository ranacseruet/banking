
  <!-- Default panel contents -->
  <h1>Transactions Summary:</h1>
  <a class="btn btn-success" href="investment/create">New Investment</a>
    <!-- Table -->
    <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Transaction Date</th>
              <th>Term Type</th>
              <th>Interest Rate</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($accounts as $index => $account)
              <tr>
                  <td>{{$account->getId()}}</td>
                  <td>{{$account->getCreateTime()->format("Y-m-d H:i:s")}}</td>
                  <td>{{$account->getTermType()}}</td>
                  <td>{{$account->getInterestRate()}}</td>
                  <td>{{$account->getAmount()}}</td>
              </tr>
              @endforeach
          </tbody>
    </table>