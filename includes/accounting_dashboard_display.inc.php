<?php
require_once "dbhed.inc.php";

$transaction_count = "SELECT COUNT(*) AS 'transaction_count' FROM credit_transactions WHERE transaction_date = CURRENT_DATE;";

$stmt1 = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt1, $transaction_count)) {
    header("location: ../login.php?error=stmtfailed");
    exit();
}

mysqli_stmt_execute($stmt1);
$result = mysqli_stmt_get_result($stmt1);
$transac_count = mysqli_fetch_assoc($result);


mysqli_stmt_close($stmt1);

$ttl_amnt = "SELECT SUM(amount) AS total_amount
            FROM credit_transactions
            WHERE transaction_date = CURRENT_DATE;";

$stmt2 = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt2, $ttl_amnt)) {
    header("location: ../login.php?error=stmtfailed");
    exit();
}

mysqli_stmt_execute($stmt2);
$result = mysqli_stmt_get_result($stmt2);
$total_amount = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt2);

$sql = "SELECT transaction_date, SUM(amount) AS total_amount
FROM credit_transactions
GROUP BY transaction_date;;";
$result = mysqli_query($conn, $sql);

foreach($result as $data)
{
    $date[] = $data['transaction_date'];
    $count[] = $data['total_amount'];
}
?>