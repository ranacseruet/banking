<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Panel heading</div>
  <div class="panel-body">
    <p>List of transfer made on your account:</p>
  </div>

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
                <td>{{$transfer->getType()}}</td>
                <td></td>
                <td>{{$transfer->getAmount()}}</td>
            </tr>
            @endforeach
        </tbody>
  </table>
</div>