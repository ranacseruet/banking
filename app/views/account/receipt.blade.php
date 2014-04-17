<html>  <!-- Default panel contents -->
    <body>
        <div align="center">
        <h4>Transaction Receipt</h4>
        </div>
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