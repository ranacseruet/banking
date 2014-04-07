<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Panel heading</div>
  <div class="panel-body">
    <p>List of transfer made on your account:</p>
  </div>
  <a class="btn btn-success" href="transfer/create">Make A New Transfer</a>
  <!-- Table -->
  <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Transfer Type</th>
            <th>Summary</th>
            <th>Amount</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($transfers as $transfer)
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
</div>