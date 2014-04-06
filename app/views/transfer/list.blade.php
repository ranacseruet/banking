
@foreach ($transfers as $transfer)
    <p>Transaction id is {{ $transfer->getAmount() }}</p>
@endforeach