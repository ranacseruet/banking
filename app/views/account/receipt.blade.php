<html>  <!-- Default panel contents -->
    <body>
        <h5>Transaction Receipt</h5>
        <hr>
        <!-- Table -->
        <pre>
            Transaction Date    : {{$transaction->getCreateTime()->format("Y-m-d H:i:s") }}

            Transaction Details : {{$transaction->getDescription()}}

            Transaction Amount  : {{$transaction->getAmount()}}

            --------------------------------------------------------------------------------------
            Total               : {{$transaction->getAmount()}} CAD

            Current Balance     : {{$transaction->getAccount()->getBalance()}} CAD
            --------------------------------------------------------------------------------------
            Thank You.
        </pre>
    </body>
</html>