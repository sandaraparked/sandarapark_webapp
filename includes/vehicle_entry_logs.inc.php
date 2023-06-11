<?php
error_reporting(0);
require_once "dbhed.inc.php";
#case1
if (empty($_SESSION["date1"]) && empty($_SESSION["date2"])) {
  //Pagination of table
  $results_per_page = 6;// define how many results you want per page

  // query/fetches all the rows in the table
  $sql='SELECT vehicle_entry_log.entry_id, user.user_id, user.name, user.plate_num AS u_plate_num, vehicle_entry_log.date_in, vehicle_entry_log.time_in, user.vi
  FROM user
  JOIN vehicle_entry_log ON vehicle_entry_log.user_id = user.user_id
  ORDER BY vehicle_entry_log.date_in DESC;';
  $num_row = mysqli_query($conn, $sql);
  $number_of_results = mysqli_num_rows($num_row);

  if (!$num_row){
      die("Invalid query: ");
  }


  $number_of_pages = ceil($number_of_results/$results_per_page);// determine number of total pages available

  // determine which page number visitor is currently on
  if (!isset($_GET['page'])) {
    $page = 1;
  } else {
    $page = $_GET['page'];
  }

  // determine the sql LIMIT starting number for the results on the displaying page
  $this_page_first_result = ($page-1)*$results_per_page;

  // retrieve selected results from database and display them on page

  $select = 'SELECT vehicle_entry_log.entry_id, user.user_id, user.name, user.plate_num AS u_plate_num, vehicle_entry_log.date_in, vehicle_entry_log.time_in, user.vi
  FROM user
  JOIN vehicle_entry_log ON vehicle_entry_log.user_id = user.user_id
  ORDER BY vehicle_entry_log.date_in DESC LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
  $stmt2 = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt2, $select)) {
      header("location: ../vehicle_entry_logs1.php?error=stmtfailed");
      exit();
  }

  mysqli_stmt_execute($stmt2);

  $result = mysqli_stmt_get_result($stmt2);
  
  }
#end
if (isset($_POST["filter"])){
    
  session_start();
  unset($_SESSION["date1"]);
  unset($_SESSION["date2"]);
  unset($_SESSION["time1"]);
  unset($_SESSION["time2"]);

    $date1 = $_POST["date1"];
    $date2 = $_POST["date2"];
    $time1 = $_POST["time1"];
    $time2 = $_POST["time2"];
    if (!empty($time1)) {
      $time1 = date("H:i", strtotime($time1));
    }
    if (!empty($time2)) {
      $time2 = date("H:i", strtotime($time2));
    }
    $_SESSION["date1"] = $_POST["date1"];
    $_SESSION["date2"] = $_POST["date2"];
    $_SESSION["time1"] = $time1;
    $_SESSION["time2"] = $time2;
    require_once 'functioneds.inc.php';

    if (no_date1($date1) !==false) {
        header("location: ../vehicle_entry_logs1.php?error=date1Required");
        exit();
    }

    if(no_time($date1, $date2, $time1, $time2) !== false) {
        header("location: ../vehicle_entry_logs1.php?error=timeRequired");
        exit();
    }

  header("location: ../vehicle_entry_logs2.php");

}
#end
#case2
if (!empty($_SESSION["date1"]) && empty($_SESSION["date2"]) && empty($_SESSION["time1"]) && empty($_SESSION["time2"])){
  //Pagination of table
  $results_per_page = 6;// define how many results you want per page

  // query/fetches all the rows in the user table
  $sql='SELECT vehicle_entry_log.entry_id, user.user_id, user.name, user.plate_num AS u_plate_num, vehicle_entry_log.date_in, vehicle_entry_log.time_in, user.vi
  FROM user
  JOIN vehicle_entry_log ON vehicle_entry_log.user_id = user.user_id
  WHERE date_in = ?
  ORDER BY vehicle_entry_log.date_in DESC;';
          $stmt = mysqli_stmt_init($conn);

          if (!mysqli_stmt_prepare($stmt, $sql)) {
              header("location: vehicle_entry_logs2.php?error=stmtfailed");
              echo "error";
              exit();
          }
          mysqli_stmt_bind_param($stmt, 's', $_SESSION["date1"]);
          mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);

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


  $select = 'SELECT vehicle_entry_log.entry_id, user.user_id, user.name, user.plate_num AS u_plate_num, vehicle_entry_log.date_in, vehicle_entry_log.time_in, user.vi
  FROM user
  JOIN vehicle_entry_log ON vehicle_entry_log.user_id = user.user_id
  WHERE date_in = ?
  ORDER BY vehicle_entry_log.date_in DESC 
  LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
  $stmt2 = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt2, $select)) {
      header("location: ../vehicle_entry_logs2.php?error=stmtfailed");
      exit();
  }
  mysqli_stmt_bind_param($stmt2, 's', $_SESSION["date1"]);
  mysqli_stmt_execute($stmt2);
  $result = mysqli_stmt_get_result($stmt2);
  }
#end
#case3
if (!empty($_SESSION["date1"]) && !empty($_SESSION["date2"]) && empty($_SESSION["time1"]) && empty($_SESSION["time2"])){
  //Pagination of table
  $results_per_page = 6;// define how many results you want per page

  // query/fetches all the rows in the user table
  $sql='SELECT vehicle_entry_log.entry_id, user.user_id, user.name, user.plate_num AS u_plate_num, vehicle_entry_log.date_in, vehicle_entry_log.time_in, user.vi
  FROM user
  JOIN vehicle_entry_log ON vehicle_entry_log.user_id = user.user_id
  WHERE DATE(date_in) BETWEEN ? AND ?;';
          $stmt = mysqli_stmt_init($conn);

          if (!mysqli_stmt_prepare($stmt, $sql)) {
              header("location: vehicle_entry_logs2.php?error=stmtfailed");
              echo "error";
              exit();
          }
          mysqli_stmt_bind_param($stmt, 'ss', $_SESSION["date1"], $_SESSION["date2"]);
          mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);

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


  $select = 'SELECT vehicle_entry_log.entry_id, user.user_id, user.name, user.plate_num AS u_plate_num, vehicle_entry_log.date_in, vehicle_entry_log.time_in, user.vi
  FROM user
  JOIN vehicle_entry_log ON vehicle_entry_log.user_id = user.user_id
  WHERE DATE(date_in) BETWEEN ? AND ? LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
  $stmt2 = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt2, $select)) {
      header("location: ../vehicle_entry_logs2.php?error=stmtfailed");
      exit();
  }
  mysqli_stmt_bind_param($stmt2, 'ss', $_SESSION["date1"], $_SESSION["date2"]);
  mysqli_stmt_execute($stmt2);
  $result = mysqli_stmt_get_result($stmt2);
}
#end
#case4
if (!empty($_SESSION["date1"]) && empty($_SESSION["date2"]) && !empty($_SESSION["time1"]) && !empty($_SESSION["time2"])){
  //Pagination of table
  $results_per_page = 6;// define how many results you want per page

  // query/fetches all the rows in the user table
  $sql='SELECT vehicle_entry_log.entry_id, user.user_id, user.name, user.plate_num AS u_plate_num, vehicle_entry_log.date_in, vehicle_entry_log.time_in, user.vi
  FROM user
  JOIN vehicle_entry_log ON vehicle_entry_log.user_id = user.user_id
  WHERE date_in = ? AND TIME(time_in) BETWEEN ? AND ?';
          $stmt = mysqli_stmt_init($conn);

          if (!mysqli_stmt_prepare($stmt, $sql)) {
              header("location: vehicle_entry_logs2.php?error=stmtfailed");
              echo "error";
              exit();
          }
          mysqli_stmt_bind_param($stmt, 'sss', $_SESSION["date1"], $_SESSION["time1"], $_SESSION["time2"]);
          mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);

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


  $select = 'SELECT vehicle_entry_log.entry_id, user.user_id, user.name, user.plate_num AS u_plate_num, vehicle_entry_log.date_in, vehicle_entry_log.time_in, user.vi
  FROM user
  JOIN vehicle_entry_log ON vehicle_entry_log.user_id = user.user_id
  WHERE date_in = ? AND TIME(time_in) BETWEEN ? AND ? LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
  $stmt2 = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt2, $select)) {
      header("location: ../vehicle_entry_logs2.php?error=stmtfailed");
      exit();
  }
  mysqli_stmt_bind_param($stmt2, 'sss', $_SESSION["date1"], $_SESSION["time1"], $_SESSION["time2"]);
  mysqli_stmt_execute($stmt2);
  $result = mysqli_stmt_get_result($stmt2);
}
#end 
#case5
if (!empty($_SESSION["date1"]) && !empty($_SESSION["date2"]) && !empty($_SESSION["time1"]) && !empty($_SESSION["time2"])){
  //Pagination of table
  $results_per_page = 6;// define how many results you want per page

  // query/fetches all the rows in the user table
  $sql='SELECT vehicle_entry_log.entry_id, user.user_id, user.name, user.plate_num AS u_plate_num, vehicle_entry_log.date_in, vehicle_entry_log.time_in, user.vi
  FROM user
  JOIN vehicle_entry_log ON vehicle_entry_log.user_id = user.user_id
  WHERE DATE(date_in) BETWEEN ? AND ? AND TIME(time_in) BETWEEN ? AND ?;';
          $stmt = mysqli_stmt_init($conn);

          if (!mysqli_stmt_prepare($stmt, $sql)) {
              header("location: vehicle_entry_logs2.php?error=stmtfailed");
              echo "error";
              exit();
          }
          mysqli_stmt_bind_param($stmt, 'ssss', $_SESSION["date1"], $_SESSION["date2"], $_SESSION["time1"], $_SESSION["time2"]);
          mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);

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


  $select = 'SELECT vehicle_entry_log.entry_id, user.user_id, user.name, user.plate_num AS u_plate_num, vehicle_entry_log.date_in, vehicle_entry_log.time_in, user.vi
  FROM user
  JOIN vehicle_entry_log ON vehicle_entry_log.user_id = user.user_id
  WHERE DATE(date_in) BETWEEN ? AND ? AND TIME(time_in) BETWEEN ? AND ? LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
  $stmt2 = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt2, $select)) {
      header("location: ../vehicle_entry_logs2.php?error=stmtfailed");
      exit();
  }
  mysqli_stmt_bind_param($stmt2, 'ssss', $_SESSION["date1"], $_SESSION["date2"], $_SESSION["time1"], $_SESSION["time2"]);
  mysqli_stmt_execute($stmt2);
  $result = mysqli_stmt_get_result($stmt2);
}
