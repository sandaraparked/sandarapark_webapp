<?php
require_once "dbhed.inc.php";
//sql query for the total number of parking spot 
$select = "SELECT (
    SELECT COUNT(*) FROM parking_spot1 WHERE parking_id IS NOT NULL
) + (
    SELECT COUNT(*) FROM parking_spot2 WHERE parking_id IS NOT NULL
) AS total_count;
";
$result = mysqli_query($conn, $select);
$total = mysqli_fetch_assoc($result);

//sql query for the total number of occupied parking spot
$select_o = "SELECT (
    SELECT COUNT(*) FROM parking_spot1 WHERE availability = 'occupied'
) + (
    SELECT COUNT(*) FROM parking_spot2 WHERE availability = 'occupied'
) AS total_count;
";
$result_o = mysqli_query($conn, $select_o);
$t_occupied = mysqli_fetch_assoc($result_o);


//sql query for the total number of available parking spot
$select_a = "SELECT (
    SELECT COUNT(*) FROM parking_spot1 WHERE availability = 'available'
) + (
    SELECT COUNT(*) FROM parking_spot2 WHERE availability = 'available'
) AS total_count;
";

$result_a = mysqli_query($conn, $select_a);
$t_available = mysqli_fetch_assoc($result_a);

//sql query for the total number of reserved parking spot
$select_r = "SELECT (
    SELECT COUNT(*) FROM parking_spot1 WHERE availability = 'reserved'
) + (
    SELECT COUNT(*) FROM parking_spot2 WHERE availability = 'reserved'
) AS total_count;
";
$result_r = mysqli_query($conn, $select_r);
$t_reserved = mysqli_fetch_assoc($result_r);

//sql query for the total number of pwd parking spot 
$select_p = "SELECT (
    SELECT COUNT(*) FROM parking_spot1 WHERE availability = 'pwd'
) + (
    SELECT COUNT(*) FROM parking_spot2 WHERE availability = 'pwd'
) AS total_count;
";
$result_p = mysqli_query($conn, $select_p);
$t_pwd = mysqli_fetch_assoc($result_p);

$select = "SELECT * FROM payment_system";

$stmt = mysqli_query($conn, $select);
$status = mysqli_fetch_assoc($stmt);


$sql = "SELECT DATE(date_in) AS date_group, COUNT(*) AS count
FROM vehicle_entry_log
GROUP BY date_group;";
$result = mysqli_query($conn, $sql);

foreach($result as $data)
{
    $date[] = $data['date_group'];
    $count[] = $data['count'];
}

?>