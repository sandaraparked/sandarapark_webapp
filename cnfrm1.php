<?PHP
require_once "includes/dbh.inc.php";
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{

    if(!isset($_GET["parking_id"]))    //Checks if the ID of the user exists in the database
    {
        echo'nonexisting ID';
        header("location:reserve_exp1_user.php");
        exit;
    }
    $parking_id = $_GET["parking_id"];//reads the ID of the user from the request

    //read the row of the selected client from database table
    $select = "SELECT * FROM parking_spot1 WHERE parking_id=$parking_id";
    $result = mysqli_query($conn,$select);
    $row = mysqli_fetch_assoc($result);

    if(!$row)
    {
        echo'an error occurred';
        exit;
    }

    $area = $row["area"];
    $spot = $row["spot"];
    $availability = $row["availability"];

    
}
else
{
    require_once "includes/dbh.inc.php";
    //POST 
    $user_id = $_POST["user_id"];
    $parking_id = $_GET["parking_id"];
    $area = $_POST["area"];
    $spot = $_POST["spot"];




    do
    {
        if (empty($area) || empty($spot)) 
        {
            $errorMessage = "All the fields are required";
            break;
        }

        $query = "SELECT availability AS availability FROM parking_spot1 
        WHERE parking_id = $parking_id";
        $check = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($check);
        
        if($row["availability"] === "reserved" or $row ["availability"] === "occupied")
        {
            $errorMessage = "Spot is already reserved, please pick another spot";
            break;
        }

        else {
            
            $update = "UPDATE parking_spot1 SET availability = 'reserved' 
            WHERE parking_id=$parking_id";
            $result = mysqli_query($conn,$update);
            $insert= "INSERT INTO exp_reservations1 (user_id, parking_id, area) VALUES ('$user_id', '$parking_id', '$area');";
            $rsrv = mysqli_query($conn,$insert);
        
            //echo'success update';


            $successMessage = "Details of the User had been updated.";

            header("location:reserve_exp1_user.php");
            exit;
        }


    }while(false);

}

