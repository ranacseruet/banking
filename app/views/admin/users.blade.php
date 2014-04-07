 <table class="table table-striped">
     <thead>
        <tr>
            <th>#</th>
            <th>Username</th>
            <th>Email</th>
        </tr>
     </thead>
     <tbody>
        @foreach($users as $iteration =>$user)
            <tr>
                <td>{{$iteration+1}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->email}}</td>
            </tr>
        @endforeach
</tbody>
</table>