<?PHP
include 'rs_conn1.php';

$select = "SELECT * FROM parking_spot1";
$result = mysqli_query($conn, $select);

if(!$result)
{
    die("Invalid query:" . $con->error);
}
?>
<div class="container-fluid" id="parking1">
                            <ul class="showcase2">
                                <div class="screen">IRTC Building</div>
                                <div class="row1">
                                    <?PHP
                                        session_start();
    while ($row = mysqli_fetch_assoc($result)) {
        echo "
            <div class='seat $row[availability]'><a href='#'>$row[spot]</a></div>
        ";
    }
?>
</div>
