<h4>Account's List For Admin Approval</h4>
<table class="table">
      <tbody>
          @foreach ($unapprovedAccounts as $account)
          <tr>
              <td>A/C. {{$account->getAccountNo()}}</td>
              <td>Applied From {{ $account->getUser()->getFirstName() . $account->getUser()->getLastName()}}</td>
              <td><a href="{{ URL::to('account/approve') . '/' . $account->getId()}}" class="btn btn-primary">Approve</a></td>
          </tr>
          @endforeach
      </tbody>
</table>