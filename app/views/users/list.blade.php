<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">User List</div>
  <div class="panel-body">
    <p></p>
  </div>

  <!-- Table -->
  <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>user Name</th>
            <th>Name</th>
            <th>Email Address</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->getId()}}</td>
                <td>{{$user->getUsername()}}</td>
                <td>{{$user->getFirstName()}} {{$user->getLastName()}}</td>
                <td>{{$user->getEmail()}}</td>
            </tr>
            @endforeach
        </tbody>
  </table>
</div>