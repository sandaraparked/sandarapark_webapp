<?php
require_once "includes/dbh.inc.php";



//Pagination of table
// define how many results you want per page
$results_per_page = 6;

// query/fetches all the rows in the user table
$sql='SELECT * FROM parking_spot1';
$result = mysqli_query($conn, $sql);
$number_of_results = mysqli_num_rows($result);

if (!$result){
    die("Invalid query: ");
}

// determine number of total pages available
$number_of_pages = ceil($number_of_results/$results_per_page);

// determine which page number visitor is currently on
if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}

// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page-1)*$results_per_page;

// retrieve selected results from database and display them on page
$sql='SELECT * FROM parking_spot1 LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
$result = mysqli_query($conn, $sql);



//delete parking spot
if(isset($_GET['del_parking']))
{
  $parking_id = $_GET['del_parking'];
  
  
  $del = "DELETE FROM user WHERE parking_id = $parking_id;";
  $del_run = mysqli_query($conn, $del);
  
  if($del_run)
  {
    $_SESSION['message'] = "Parking spot deleted successfully"; 
    header('location:parking_spot1.php');
    exit(0);
  } 

}


//update parking
if(isset($_POST['update_parking_spot1'])) {
    $parking_id = $_POST['parking_id'];
    $area = $_POST['area'];
    $spot = $_POST['spot'];
    $availability = $_POST['availability'];

    $update = "UPDATE parking_spot1 SET area='$area', spot='$spot', availability='$availability' WHERE parking_id=$parking_id ";
    $update_run = mysqli_query($conn, $update);

    if($update_run)
    {
      $_SESSION['message'] = "Parking Space updated successfully"; 
	      header('location:parking_spot1.php');
        exit(0);
    }
}

?>