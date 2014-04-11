<html>  <!-- Default panel contents -->
    <body>
        <h4>A/C. {{ $account->getAccountNo() }} ({{ ucfirst($account->getType()) }} Account)</h4>
        <!-- Table -->
        <table border="1">
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
                      <td>{{ strtoupper($transfer->getType())}}</td>
                      <td>{{$transfer->getDescription()}}</td>
                      <td>{{$transfer->getAmount()}}</td>
                  </tr>
                  @endforeach
              </tbody>
        </table>
    </body>
</html>