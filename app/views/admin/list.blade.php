<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">User List</div>
  <div class="panel-body">
    <p></p>
  </div>
  <a class="btn btn-success" href="user/registration">Create New User</a>
  <!-- Table -->
  <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>user Name</th>
            <th>Name</th>
            <th>Email Address</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->getId()}}</td>
                <td>{{$user->getUsername()}}</td>
                <td>{{$user->getFirstName()}} {{$user->getLastName()}}</td>
                <td>{{$user->getEmail()}}</td>
                <td><a href="account/create/id/{{$user->getId()}}" class="btn btn-primary">Create Account</a></td>
            </tr>
            @endforeach
        </tbody>
  </table>
</div>