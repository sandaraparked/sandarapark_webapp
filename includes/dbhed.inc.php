<?PHP
error_reporting(0);
session_start();

$host = "localhost";
$user = "root";
$db_password = "";
$db = "sandaraparkdb";

$conn = mysqli_connect($host, $user, $db_password, $db);

if(!$conn)
{
    die("connection failed:" . mysqli_connect_error());
}

?>