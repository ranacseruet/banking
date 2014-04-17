<html>  <!-- Default panel contents -->
    <body>
        <h5>Transaction Receipt</h5>
        <p>--------------------------------------------------------------------------------------</p>
        <!-- Table -->
        <pre>
            Transaction Date    : {{$transaction->getCreateTime()->format("Y-m-d H:i:s") }}
            Transaction Details : {{$transaction->getDescription()}}

            Transaction Amount  : {{$transaction->getAmmount()}}
            --------------------------------------------------------------------------------------
            Total               : {{$transaction->getAmmount()}} CAD

            Current Balance     : {{$transaction->getAccount()->getBalance()}} CAD
            --------------------------------------------------------------------------------------
            Thank You.
        </pre>
    </body>
</html>