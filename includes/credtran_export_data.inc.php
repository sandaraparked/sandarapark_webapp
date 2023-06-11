<?php
error_reporting(0);
session_start();
include_once "dbhed.inc.php";
    $file_name = "credit_transactions_data_" . date('Y-m-d') . ".csv";
    // Set headers for CSV download
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . $file_name);
  
    // Open file pointer to output CSV data
    $fp = fopen('php://output', 'w');
  
    // Get column names from table
    $columns = [];
    $query = "SHOW COLUMNS FROM credit_transactions";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
      $columns[] = $row['Field'];
    }
    //caution
    array_push($columns, 'the transaction_date column is in "d-m-Y" format');

    // Write column names to CSV file
    fputcsv($fp, $columns);

    // Get data from table and write to CSV file
    #case1
    if (empty($_SESSION["date1"]) && empty($_SESSION["date2"]) && empty($_SESSION["time1"]) && empty($_SESSION["time2"])) {        
        $sql='SELECT * FROM credit_transactions;';
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($fp, $row);
        }
    }

    #case2
    if (!empty($_SESSION["date1"]) && empty($_SESSION["date2"]) && empty($_SESSION["time1"]) && empty($_SESSION["time2"])){
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
        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($fp, $row);
            }
    }

    #case3
    if (!empty($_SESSION["date1"]) && !empty($_SESSION["date2"]) && empty($_SESSION["time1"]) && empty($_SESSION["time2"])){
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
        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($fp, $row);
            }
    }

    #case4
    if (!empty($_SESSION["date1"]) && empty($_SESSION["date2"]) && !empty($_SESSION["time1"]) && !empty($_SESSION["time2"])){
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
        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($fp, $row);
            }
        }

    #case5
    if (!empty($_SESSION["date1"]) && !empty($_SESSION["date2"]) && !empty($_SESSION["time1"]) && !empty($_SESSION["time2"])){
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
        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($fp, $row);
            }
    }

    // Close file pointer
    fclose($fp);
    exit();
