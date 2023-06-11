<?php
error_reporting(0);
session_start();
include_once "dbhed.inc.php";
    $file_name = "vehicle_entry_log_data_" . date('Y-m-d') . ".csv";
    // Set headers for CSV download
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . $file_name);
  
    // Open file pointer to output CSV data
    $fp = fopen('php://output', 'w');
  
    // Get column names from table
    $columns = [];
    $query = 'SELECT vehicle_entry_log.entry_id, user.user_id, user.name, user.plate_num AS u_plate_num, vehicle_entry_log.date_in, vehicle_entry_log.time_in
    FROM user
    JOIN vehicle_entry_log ON vehicle_entry_log.user_id = user.user_id LIMIT 0;';
    $data = mysqli_query($conn, $query);
    $fields = mysqli_fetch_fields($data);
    foreach($fields as $field){
        $columns[] = $field->name;
    }
    //caution
    array_push($columns, 'the date_in column is in "d-m-Y" format');

    // Write column names to CSV file
    fputcsv($fp, $columns);
  

    // Get data from table and write to CSV file
    include_once "encdec.inc.php";
    #case1
    if (empty($_SESSION["date1"]) && empty($_SESSION["date2"])) {
        $sql='SELECT vehicle_entry_log.entry_id, user.user_id, user.name, user.plate_num 
        AS u_plate_num, vehicle_entry_log.date_in, vehicle_entry_log.time_in, user.vi
        FROM user
        JOIN vehicle_entry_log ON vehicle_entry_log.user_id = user.user_id;';
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {

            $plate_num = openssl_decrypt($row["u_plate_num"], $method, $key, 0, $row["vi"]);

            $row["u_plate_num"] = $plate_num;
            fputcsv($fp, $row);
        }
    }

    #case2
    if (!empty($_SESSION["date1"]) && empty($_SESSION["date2"]) && empty($_SESSION["time1"]) && empty($_SESSION["time2"])){
        $sql='SELECT vehicle_entry_log.entry_id, user.user_id, user.name, user.plate_num AS u_plate_num, vehicle_entry_log.date_in, vehicle_entry_log.time_in, user.vi
        FROM user
        JOIN vehicle_entry_log ON vehicle_entry_log.user_id = user.user_id
        WHERE date_in = ?;';
                $stmt = mysqli_stmt_init($conn);
    
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("location: vehicle_entry_logs2.php?error=stmtfailed");
                    echo "error";
                    exit();
                }
                mysqli_stmt_bind_param($stmt, 's', $_SESSION["date1"]);
                mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $plate_num = openssl_decrypt($row["u_plate_num"], $method, $key, 0, $row["vi"]);
            $row["u_plate_num"] = $plate_num;
            fputcsv($fp, $row);
        }
    }

    #case3
    if (!empty($_SESSION["date1"]) && !empty($_SESSION["date2"]) && empty($_SESSION["time1"]) && empty($_SESSION["time2"])){
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
        while ($row = mysqli_fetch_assoc($result)) {
            $plate_num = openssl_decrypt($row["u_plate_num"], $method, $key, 0, $row["vi"]);
            $row["u_plate_num"] = $plate_num;
            fputcsv($fp, $row);
        }
    }

    #case4
    if (!empty($_SESSION["date1"]) && empty($_SESSION["date2"]) && !empty($_SESSION["time1"]) && !empty($_SESSION["time2"])){
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
        while ($row = mysqli_fetch_assoc($result)) {
            $plate_num = openssl_decrypt($row["u_plate_num"], $method, $key, 0, $row["vi"]);
            $row["u_plate_num"] = $plate_num;
            fputcsv($fp, $row);
        }
    }

    #case5
    if (!empty($_SESSION["date1"]) && !empty($_SESSION["date2"]) && !empty($_SESSION["time1"]) && !empty($_SESSION["time2"])){
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
        while ($row = mysqli_fetch_assoc($result)) {
            $plate_num = openssl_decrypt($row["u_plate_num"], $method, $key, 0, $row["vi"]);
            $row["u_plate_num"] = $plate_num;
            fputcsv($fp, $row);
        }
    }
    // Close file pointer
    fclose($fp);
    exit();
  