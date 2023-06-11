<?php
require_once "dbhed.inc.php";

if (empty($_SESSION["date1"]) && empty($_SESSION["date2"])) {

  $results_per_page = 6;
  session_start();

  $sql='SELECT *, user.plate_num AS u_plate_num
  FROM hash
  JOIN user ON user.user_id = hash.user_id
  JOIN vehicle_entry_log ON vehicle_entry_log.user_id = user.user_id
  WHERE vehicle_entry_log.user_id = ?
  ORDER BY vehicle_entry_log.date_in DESC;';

  $stmt1 = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt1, $sql)) {
    header("location: ../vehicle_entry_logs1.php?error=stmtfailed");
    exit();
  }

  mysqli_stmt_bind_param($stmt1, "i", $_SESSION["user_id"],);
  mysqli_stmt_execute($stmt1);
  
  $result = mysqli_stmt_get_result($stmt1);
  $number_of_results = mysqli_num_rows($result);
  
  if (!$result){
      die("Invalid query: ");
  }


  $number_of_pages = ceil($number_of_results/$results_per_page);

  // determine which page number visitor is currently on
  if (!isset($_GET['page'])) {
    $page = 1;
  } else {
    $page = $_GET['page'];
  }

  $this_page_first_result = ($page-1)*$results_per_page;

  $select = 'SELECT *, user.plate_num AS u_plate_num
  FROM hash
  JOIN user ON user.user_id = hash.user_id
  JOIN vehicle_entry_log ON vehicle_entry_log.user_id = user.user_id
  WHERE vehicle_entry_log.user_id = ? 
  ORDER BY vehicle_entry_log.date_in DESC LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
  $stmt2 = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt2, $select)) {
      header("location: ../vehicle_entry_logs1.php?error=stmtfailed");
      exit();
  }
  mysqli_stmt_bind_param($stmt2, "i", $_SESSION["user_id"]);
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
    $_SESSION["date1"] = $_POST["date1"];
    $_SESSION["date2"] = $_POST["date2"];
    $_SESSION["time1"] = $_POST["time1"];
    $_SESSION["time2"] = $_POST["time2"];
    require_once 'functioneds.inc.php';

    if (no_date1($date1) !==false) {
        header("location: ../vehicle_entry_logs1.php?error=date1Required");
        exit();
    }

    if(no_time($date1, $date2, $time1, $time2) !== false) {
        header("location: ../vehicle_entry_logs1.php?error=timeRequired");
        exit();
    }

  header("location: ../user_vehicle_entry_log2.php");

}
#end
#case1
if (!empty($_SESSION["date1"]) && empty($_SESSION["date2"]) && empty($_SESSION["time1"]) && empty($_SESSION["time2"])){

  $results_per_page = 6;

  $sql='SELECT *, user.plate_num as u_plate_num
  FROM hash
  JOIN user ON user.user_id = hash.user_id
  JOIN vehicle_entry_log ON vehicle_entry_log.user_id = hash.user_id WHERE date_in = ? AND user.user_id = ?;';
          $stmt = mysqli_stmt_init($conn);

          if (!mysqli_stmt_prepare($stmt, $sql)) {
              header("location: vehicle_entry_logs2.php?error=stmtfailed");
              echo "error";
              exit();
          }
          mysqli_stmt_bind_param($stmt, 'si', $_SESSION["date1"], $_SESSION["user_id"]);
          mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);

  $number_of_results = mysqli_num_rows($result);

  if (!$result){
      die("Invalid query: ");
  }

  $number_of_pages = ceil($number_of_results/$results_per_page);
  // determine which page number visitor is currently on
  if (!isset($_GET['page'])) {
  $page = 1;
  } else {
  $page = $_GET['page'];
  }

  $this_page_first_result = ($page-1)*$results_per_page;

  $select = 'SELECT * , user.plate_num as u_plate_num
  FROM hash
  JOIN user ON user.user_id = hash.user_id
  JOIN vehicle_entry_log ON vehicle_entry_log.user_id = hash.user_id WHERE date_in = ? AND user.user_id = ? LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
  $stmt2 = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt2, $select)) {
      header("location: ../vehicle_entry_logs2.php?error=stmtfailed");
      exit();
  }
  mysqli_stmt_bind_param($stmt2, 'si', $_SESSION["date1"], $_SESSION["user_id"]);
  mysqli_stmt_execute($stmt2);
  $result = mysqli_stmt_get_result($stmt2);
  }
#end
#case2
if (!empty($_SESSION["date1"]) && !empty($_SESSION["date2"]) && empty($_SESSION["time1"]) && empty($_SESSION["time2"])){

  $results_per_page = 6;

  $sql='SELECT * , user.plate_num as u_plate_num
  FROM hash
  JOIN user ON user.user_id = hash.user_id
  JOIN vehicle_entry_log ON vehicle_entry_log.user_id = hash.user_id WHERE DATE(date_in) BETWEEN ? AND ? AND user.user_id = ?;';
          $stmt = mysqli_stmt_init($conn);

          if (!mysqli_stmt_prepare($stmt, $sql)) {
              header("location: vehicle_entry_logs2.php?error=stmtfailed");
              echo "error";
              exit();
          }
          mysqli_stmt_bind_param($stmt, 'ssi', $_SESSION["date1"], $_SESSION["date2"], $_SESSION["user_id"]);
          mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);

  $number_of_results = mysqli_num_rows($result);

  if (!$result){
      die("Invalid query: ");
  }

  $number_of_pages = ceil($number_of_results/$results_per_page);

  // determine which page number visitor is currently on
  if (!isset($_GET['page'])) {
  $page = 1;
  } else {
  $page = $_GET['page'];
  }

  $this_page_first_result = ($page-1)*$results_per_page;

  $select = 'SELECT * , user.plate_num as u_plate_num
  FROM hash
  JOIN user ON user.user_id = hash.user_id
  JOIN vehicle_entry_log ON vehicle_entry_log.user_id = hash.user_id WHERE DATE(date_in) BETWEEN ? AND ? AND user.user_id = ? LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
  $stmt2 = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt2, $select)) {
      header("location: ../vehicle_entry_logs2.php?error=stmtfailed");
      exit();
  }
  mysqli_stmt_bind_param($stmt2, 'ssi', $_SESSION["date1"], $_SESSION["date2"], $_SESSION["user_id"]);
  mysqli_stmt_execute($stmt2);
  $result = mysqli_stmt_get_result($stmt2);
}
#end
#case3
if (!empty($_SESSION["date1"]) && empty($_SESSION["date2"]) && !empty($_SESSION["time1"]) && !empty($_SESSION["time2"])){

  $results_per_page = 6;

  $sql='SELECT * , user.plate_num as u_plate_num
  FROM hash
  JOIN user ON user.user_id = hash.user_id
  JOIN vehicle_entry_log ON vehicle_entry_log.user_id = hash.user_id WHERE date_in = ? AND TIME(time_in) BETWEEN ? AND ? AND user.user_id = ?;';
          $stmt = mysqli_stmt_init($conn);

          if (!mysqli_stmt_prepare($stmt, $sql)) {
              header("location: vehicle_entry_logs2.php?error=stmtfailed");
              echo "error";
              exit();
          }
          mysqli_stmt_bind_param($stmt, 'sssi', $_SESSION["date1"], $_SESSION["time1"], $_SESSION["time2"], $_SESSION["user_id"]);
          mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);

  $number_of_results = mysqli_num_rows($result);

  if (!$result){
      die("Invalid query: ");
  }

  $number_of_pages = ceil($number_of_results/$results_per_page);

  // determine which page number visitor is currently on
  if (!isset($_GET['page'])) {
  $page = 1;
  } else {
  $page = $_GET['page'];
  }

  $this_page_first_result = ($page-1)*$results_per_page;

  $select = 'SELECT * , user.plate_num as u_plate_num
  FROM hash
  JOIN user ON user.user_id = hash.user_id
  JOIN vehicle_entry_log ON vehicle_entry_log.user_id = hash.user_id WHERE date_in = ? AND TIME(time_in) BETWEEN ? AND ? AND user.user_id = ? LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
  $stmt2 = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt2, $select)) {
      header("location: ../vehicle_entry_logs2.php?error=stmtfailed");
      exit();
  }
  mysqli_stmt_bind_param($stmt2, 'sssi', $_SESSION["date1"], $_SESSION["time1"], $_SESSION["time2"], $_SESSION["user_id"]);
  mysqli_stmt_execute($stmt2);
  $result = mysqli_stmt_get_result($stmt2);
}
#end 
#case4
if (!empty($_SESSION["date1"]) && !empty($_SESSION["date2"]) && !empty($_SESSION["time1"]) && !empty($_SESSION["time2"])){

  $results_per_page = 6;

  $sql='SELECT * , user.plate_num as u_plate_num
  FROM hash
  JOIN user ON user.user_id = hash.user_id
  JOIN vehicle_entry_log ON vehicle_entry_log.user_id = hash.user_id WHERE DATE(date_in) BETWEEN ? AND ? AND TIME(time_in) BETWEEN ? AND ? AND user.user_id = ?;';
          $stmt = mysqli_stmt_init($conn);

          if (!mysqli_stmt_prepare($stmt, $sql)) {
              header("location: vehicle_entry_logs2.php?error=stmtfailed");
              echo "error";
              exit();
          }
          mysqli_stmt_bind_param($stmt, 'ssssi', $_SESSION["date1"], $_SESSION["date2"], $_SESSION["time1"], $_SESSION["time2"], $_SESSION["user_id"]);
          mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);

  $number_of_results = mysqli_num_rows($result);

  if (!$result){
      die("Invalid query: ");
  }

  $number_of_pages = ceil($number_of_results/$results_per_page);

  // determine which page number visitor is currently on
  if (!isset($_GET['page'])) {
  $page = 1;
  } else {
  $page = $_GET['page'];
  }

  $this_page_first_result = ($page-1)*$results_per_page;

  $select = 'SELECT * , user.plate_num as u_plate_num
  FROM hash
  JOIN user ON user.user_id = hash.user_id
  JOIN vehicle_entry_log ON vehicle_entry_log.user_id = hash.user_id WHERE DATE(date_in) BETWEEN ? AND ? AND TIME(time_in) BETWEEN ? AND ? AND user.user_id = ? LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
  $stmt2 = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt2, $select)) {
      header("location: ../vehicle_entry_logs2.php?error=stmtfailed");
      exit();
  }
  mysqli_stmt_bind_param($stmt2, 'ssssi', $_SESSION["date1"], $_SESSION["date2"], $_SESSION["time1"], $_SESSION["time2"], $_SESSION["user_id"]);
  mysqli_stmt_execute($stmt2);
  $result = mysqli_stmt_get_result($stmt2);
}
