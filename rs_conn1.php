<?PHP
require_once 'includes/dbhed.inc.php';


$select = "SELECT * FROM parking_spot1";
$result = mysqli_query($conn, $select);

if(!$result)
{
    die("Invalid query:" . $con->error);
}



?>