<h4>Dear {{$user->getLastName()}}, {{$user->getFirstName()}} Welcome to your Online Banking System</h4>

<p></p>
<br/>
<br/>

<!-- Table -->
<table class="table">
      <tbody>
          @foreach ($accounts as $account)
          <tr>
              <td><a href="{{ URL::to('account/index/' . $account->getId()) }}">A/C. {{$account->getAccountNo()}}</a></td>
              <td>{{ucfirst($account->getType())}} Account</td>
              <td>{{$account->getBalance()}} CAD</td>
          </tr>
          @endforeach
      </tbody>
</table>
<br/>
<br/>
<p>New Account: <a href="{{ URL::to('account/accountcreatebyuser') }}">Apply Here</a></p>
