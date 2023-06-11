<?php

include 'rs_conn2.php';

$select = "SELECT * FROM parking_spot2";
$result = mysqli_query($conn, $select);

if(!$result)
{
    die("Invalid query:" . $con->error);
}
?>


<div class="container-fluid" id="parking2">
    <ul class="showcase-main2">
        <div class="screen">Tech Educ Building</div>
            <div class="row2">
                <?PHP
                    session_start();
                    while ($row = mysqli_fetch_assoc($result)) {
                            echo "
                            <div class='seat $row[availability]'><a href='edit_parking_spot2.php?parking_id=$row[parking_id]'>$row[spot]</a></div>";
                        }

                ?>
            </div>
    </ul>    
</div>
