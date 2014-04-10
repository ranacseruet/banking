<p>Dear {{$user->username}}, Welcome to Admin Dashboard</p>
<br/>
<br/>
 <!-- Default panel contents -->
  <div class="panel-heading">User List</div>
  <div class="panel-body">
    <p></p>
  </div>
  <a class="btn btn-success" href="{{ URL::to('users/register') }}">Create New User</a>
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
                <td><a href="{{ URL::to('admin/userdetails') . '/' . $user->getId()}}" class="btn btn-primary">Account Details</a>
                    <a href="{{ URL::to('account/create') .'/' . $user->getId()}}" class="btn btn-primary">Create Account</a>
                </td>
            </tr>
            @endforeach
        </tbody>
  </table>