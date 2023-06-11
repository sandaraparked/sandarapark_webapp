<?php
error_reporting(0);
require_once "dbhed.inc.php";
#case1
if (empty($_SESSION["date1"]) && empty($_SESSION["date2"])) {

    $results_per_page = 6;
    
    $sql='SELECT * FROM credit_transactions;';
    $result = mysqli_query($conn, $sql);
    $number_of_results = mysqli_num_rows($result);
    
    if (!$result){
    die("Invalid query: ");
    }
    
    $number_of_pages = ceil($number_of_results/$results_per_page);
    

    if (!isset($_GET['page'])) {
    $page = 1;
    } else {
    $page = $_GET['page'];
    }
    
    $this_page_first_result = ($page-1)*$results_per_page;

    $select = 'SELECT * FROM credit_transactions LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
    $stmt2 = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt2, $select)) {
    header("location: ../login.php?error=stmtfailed");
    exit();
    }
    
    mysqli_stmt_execute($stmt2);
    
    $result = mysqli_stmt_get_result($stmt2);
    
    }
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
        header("location: ../credit_transactions1.php?error=date1Required");
        exit();
    }

    if(no_time($date1, $date2, $time1, $time2) !== false) {
        header("location: ../credit_transactions1.php?error=timeRequired");
        exit();
    }

    header("location: ../credit_transactions2.php");

}
#case2
if (!empty($_SESSION["date1"]) && empty($_SESSION["date2"]) && empty($_SESSION["time1"]) && empty($_SESSION["time2"])){

    $results_per_page = 6;

    $sql='SELECT * FROM credit_transactions WHERE transaction_date = ?;';
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: credit_transactions1.php?error=stmtfailed");
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

    $number_of_pages = ceil($number_of_results/$results_per_page);

    if (!isset($_GET['page'])) {
    $page = 1;
    } else {
    $page = $_GET['page'];
    }

    $this_page_first_result = ($page-1)*$results_per_page;

    $select = 'SELECT * FROM credit_transactions WHERE transaction_date = ? LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
    $stmt2 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt2, $select)) {
        header("location: ../credit_transactions1.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt2, 's', $_SESSION["date1"]);
    mysqli_stmt_execute($stmt2);
    $result = mysqli_stmt_get_result($stmt2);
    }
#end

#case3
if (!empty($_SESSION["date1"]) && !empty($_SESSION["date2"]) && empty($_SESSION["time1"]) && empty($_SESSION["time2"])){

    $results_per_page = 6;

    $sql='SELECT * FROM credit_transactions WHERE DATE(transaction_date) BETWEEN ? AND ?;';
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: credit_transactions1.php?error=stmtfailed");
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

    $number_of_pages = ceil($number_of_results/$results_per_page);

    if (!isset($_GET['page'])) {
    $page = 1;
    } else {
    $page = $_GET['page'];
    }

    $this_page_first_result = ($page-1)*$results_per_page;

    $select = 'SELECT * FROM credit_transactions WHERE DATE(transaction_date) BETWEEN ? AND ? LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
    $stmt2 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt2, $select)) {
        header("location: ../credit_transactions1.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt2, 'ss', $_SESSION["date1"], $_SESSION["date2"]);
    mysqli_stmt_execute($stmt2);
    $result = mysqli_stmt_get_result($stmt2);
}
#end

#case4
if (!empty($_SESSION["date1"]) && empty($_SESSION["date2"]) && !empty($_SESSION["time1"]) && !empty($_SESSION["time2"])){

    $results_per_page = 6;

    $sql='SELECT * FROM credit_transactions WHERE transaction_date= ? AND TIME(transaction_time) BETWEEN ? AND ?;';
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: credit_transactions1.php?error=stmtfailed");
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

    $number_of_pages = ceil($number_of_results/$results_per_page);

    if (!isset($_GET['page'])) {
    $page = 1;
    } else {
    $page = $_GET['page'];
    }

    $this_page_first_result = ($page-1)*$results_per_page;

    $select = 'SELECT * FROM credit_transactions WHERE transaction_date = ? AND TIME(transaction_time) BETWEEN ? AND ? LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
    $stmt2 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt2, $select)) {
        header("location: ../credit_transactions1.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt2, 'sss', $_SESSION["date1"], $_SESSION["time1"], $_SESSION["time2"]);
    mysqli_stmt_execute($stmt2);
    $result = mysqli_stmt_get_result($stmt2);
}
#end

#case5
if (!empty($_SESSION["date1"]) && !empty($_SESSION["date2"]) && !empty($_SESSION["time1"]) && !empty($_SESSION["time2"])){

    $results_per_page = 6;

    $sql='SELECT * FROM credit_transactions WHERE DATE(transaction_date) BETWEEN ? AND ? AND TIME(transaction_time) BETWEEN ? AND ?;';
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: credit_transactions1.php?error=stmtfailed");
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

    $number_of_pages = ceil($number_of_results/$results_per_page);

    if (!isset($_GET['page'])) {
    $page = 1;
    } else {
    $page = $_GET['page'];
    }

    $this_page_first_result = ($page-1)*$results_per_page;

    $select = 'SELECT * FROM credit_transactions WHERE DATE(transaction_date) BETWEEN ? AND ? AND TIME(transaction_time) BETWEEN ? AND ? LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
    $stmt2 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt2, $select)) {
        header("location: ../credit_transactions1.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt2, 'ssss', $_SESSION["date1"], $_SESSION["date2"], $_SESSION["time1"], $_SESSION["time2"]);
    mysqli_stmt_execute($stmt2);
    $result = mysqli_stmt_get_result($stmt2);
}
