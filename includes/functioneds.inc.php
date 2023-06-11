<?PHP

//error handlers for login
function empty_InputLogin($username, $password) {
    $result;
    if (empty($username) || empty($password)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

//login function
function login($conn, $username, $password) {
    session_start();
    //check payment system status
    $select1 = "SELECT * FROM payment_system";
    $stmt1 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt1, $select1)) {
        header("location: ../login.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_execute($stmt1);
    
    $rsd = mysqli_stmt_get_result($stmt1);

    if (mysqli_num_rows($rsd) > 0) {
        $res = mysqli_fetch_assoc($rsd);
        $_SESSION["ps_status"] = $res["status"];
    }
    mysqli_stmt_close($stmt1);

    $select = "SELECT * from hash JOIN user ON user.user_id = hash.user_id WHERE hash.h_username = ? AND hash.password = ?";
    $stmt2 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt2, $select)) {
        header("location: ../login.php?error=stmtfailed");
        exit();
    }

    $h_username = hash('sha256', $username);
    $password= hash('sha256', $password);

    mysqli_stmt_bind_param($stmt2, "ss", $h_username, $password);
    mysqli_stmt_execute($stmt2);

    $result_Data = mysqli_stmt_get_result($stmt2);
    
    if (mysqli_num_rows($result_Data) > 0) {
        include "encdec.inc.php";
        $rsp = mysqli_fetch_assoc($result_Data);
        $name = openssl_decrypt($rsp["name"], $method, $key, 0, $rsp["vi"]);
        $email = openssl_decrypt($rsp["email"], $method, $key, 0, $rsp["vi"]);
        $plate_num = openssl_decrypt($rsp["plate_num"], $method, $key, 0, $rsp["vi"]);
        $username = openssl_decrypt($rsp["username"], $method, $key, 0, $rsp["vi"]);
        $user_type = openssl_decrypt($rsp["user_type"], $method, $key, 0, $rsp["vi"]);
        $_SESSION["user_id"] = $rsp["user_id"];
        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;
        $_SESSION["plate_num"] = $plate_num;
        $_SESSION["username"] = $username;
        $_SESSION["user_type"] = $user_type;
        $_SESSION["credit_balance"] = $rsp["credit_balance"];

        if ($_SESSION["user_type"] === "admin") {
            header("location: ../dashboard_admin.php");
            $insert = "INSERT INTO digital_footprint (accessed_by, accessed_table, action_done, date_accessed, time_accessed) VALUES (?, ?, ?, CURRENT_DATE, DATE_ADD(CURRENT_TIME(), INTERVAL 8 HOUR));";
    
            $accessed_table = "none";
            $action_done = "logged in";

                    $stmt3 = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt3, $insert)) {
                        header("location: ../login.php?error=stmtfailed");
                        exit();
                    }
        
                    mysqli_stmt_prepare($stmt3,$insert);
                    mysqli_stmt_bind_param($stmt3, "iss", $_SESSION["user_id"], $accessed_table, $action_done);
                    mysqli_stmt_execute($stmt3);

            mysqli_stmt_close($stmt1);
            mysqli_stmt_close($stmt2);
            mysqli_stmt_close($stmt3);
            exit();
        }
        elseif ($_SESSION["user_type"] === "user") {
            header("location: ../dashboard_user.php");
            mysqli_stmt_close($stmt1);
            mysqli_stmt_close($stmt2);

            exit();
        }
        elseif ($_SESSION["user_type"] === "security") {
            header("location: ../dashboard_security.php");
            $insert = "INSERT INTO digital_footprint (accessed_by, accessed_table, action_done, date_accessed, time_accessed) VALUES (?, ?, ?, CURRENT_DATE, DATE_ADD(CURRENT_TIME(), INTERVAL 8 HOUR));";

            $accessed_table = "none";
            $action_done = "logged in";

                    $stmt3 = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt3, $insert)) {
                        header("location: ../login.php?error=stmtfailed");
                        exit();
                    }

                    mysqli_stmt_prepare($stmt3,$insert);
                    mysqli_stmt_bind_param($stmt3, "iss", $_SESSION["user_id"], $accessed_table, $action_done);
                    mysqli_stmt_execute($stmt3);

            mysqli_stmt_close($stmt1);
            mysqli_stmt_close($stmt2);
            mysqli_stmt_close($stmt3);
            exit();
        }
        elseif ($_SESSION["user_type"] === "accounting") {
            header("location: ../dashboard_accounting.php");
            $insert = "INSERT INTO digital_footprint (accessed_by, accessed_table, action_done, date_accessed, time_accessed) VALUES (?, ?, ?, CURRENT_DATE, DATE_ADD(CURRENT_TIME(), INTERVAL 8 HOUR));";
    
            $accessed_table = "none";
            $action_done = "logged in";

                    $stmt3 = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt3, $insert)) {
                        header("location: ../login.php?error=stmtfailed");
                        exit();
                    }
        

                    mysqli_stmt_prepare($stmt3,$insert);
                    mysqli_stmt_bind_param($stmt3, "iss", $_SESSION["user_id"], $accessed_table, $action_done);
                    mysqli_stmt_execute($stmt3);

            mysqli_stmt_close($stmt1);
            mysqli_stmt_close($stmt2);
            mysqli_stmt_close($stmt3);
            exit();
        }

    }
else {
    header("location: ../login.php?error=errorlogin");
    exit();
    }
}

//functions for signup, add_user, edit_user, change password

function empty_Input_update($name, $plate_num, $username) {
    $result;
    if (empty($name) || empty($plate_num) || empty($username)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function empty_Input_Signup($name, $plate_num, $username, $password, $c_password) {
    $result;
    if (empty($name) || empty($plate_num) || empty($username) || empty($password) || empty($c_password)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function empty_Input_Signup1($name, $email, $username,$plate_num) {
    $result;
    if (empty($name) || empty($plate_num) || empty($username) || empty($email) || empty($c_password)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

//empty input add user
function empty_input_addu($name, $username, $password, $c_password) {
    $result;
    if (empty($name) || empty($username) || empty($password) || empty($c_password)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalid_Username($username) {
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalid_Email($email) {
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function password_Match($password, $c_password) {
    $result;
    //this function checks if the password matches
    if ($password !== $c_password) {
        $result = true;
    }
    else {
        $result = false;        
    }
    return $result;
}

function signup_username_Exist($conn, $username) {
    $select = "SELECT * FROM hash
    WHERE h_username = ?;";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $select)) {
        header("location: ../signup_form.php?error=stmtfailed");
        exit();
    }
    $h_username = hash('sha256', $username);
    mysqli_stmt_bind_param($stmt, "s", $h_username);
    mysqli_stmt_execute($stmt);

    $result_Data = mysqli_stmt_get_result($stmt);

    if ($rsp = mysqli_fetch_assoc($result_Data)) {
        return $rsp;
    }
    else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function signup_email_Exist($conn, $email) {
    $select = "SELECT * FROM hash
    WHERE h_email = ?;";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $select)) {
        header("location: ../signup_form.php?error=stmtfailed");
        exit();
    }

    $h_email = hash('sha256', $email);
    mysqli_stmt_bind_param($stmt, "s", $h_email);
    mysqli_stmt_execute($stmt);

    $result_Data = mysqli_stmt_get_result($stmt);

    if ($rsp = mysqli_fetch_assoc($result_Data)) {
        return $rsp;
    }
    else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function signup_plate_num_Exist($conn, $plate_num) {
    $select = "SELECT * FROM hash
    WHERE h_plate_num = ?;";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $select)) {
        header("location: ../signup_form.php?error=stmtfailed");
        exit();
    }
    $plate_num = trim(preg_replace('/[^A-Za-z0-9]/', '', $plate_num));
    $h_plate_num = hash('sha256', $plate_num);
    mysqli_stmt_bind_param($stmt, "s", $h_plate_num);
    mysqli_stmt_execute($stmt);

    $result_Data = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result_Data) > 0) {
        $result = true;
        return $result;
    }
    else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

//create new account for user
function create_User($conn, $name, $plate_num, $email, $username, $password) {
    session_start();
    $insert1 = "INSERT INTO hash (h_email, h_plate_num, h_username, password)
    VALUES (?, ?, ?, ?);";

    $stmt1 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt1, $insert1)) {
        header("location: ../signup_form.php?error=stmtfailed");
        exit();
    }
 
    $h_email = hash('sha256', $email);
    $h_plate_num = hash('sha256', $plate_num);
    $h_username = hash('sha256', $username);
    $pwd = hash('sha256', $password);

    mysqli_stmt_bind_param($stmt1, "ssss", $h_email, $h_plate_num,  $h_username, $pwd);
    mysqli_stmt_execute($stmt1);

    $insert2 = "INSERT INTO user (name, email, plate_num, username, credit_balance, vi,user_type)
    VALUES (?, ?, ?, ?, ?, ?, ?);";
    $stmt2 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt2, $insert2)) {
        header("location: ../signup_form.php?error=stmtfailed");
        exit();
    }
    
    $credit_balance = 0;
    require_once "encdec.inc.php";
    $enc_name= openssl_encrypt($name, $method, $key, 0, $iv);
    $enc_email= openssl_encrypt($email, $method, $key, 0, $iv);
    $enc_plate_num= openssl_encrypt($plate_num, $method, $key, 0, $iv);
    $enc_username= openssl_encrypt($username, $method, $key, 0, $iv);
    $enc_user_type= openssl_encrypt($s_user_type, $method, $key, 0, $iv);

    mysqli_stmt_bind_param($stmt2, "ssssiss", $enc_name, $enc_email, $enc_plate_num,  $enc_username, $credit_balance, $iv, $enc_user_type);
    mysqli_stmt_execute($stmt2);

    session_start();
    //check payment system status
    $select4 = "SELECT * FROM payment_system WHERE status = ?";
    $stmt4 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt4, $select4)) {
        $result = false;
        $_SESSION["ps_status"] = $result;
        exit();
    }
    
    $status = "on";
    mysqli_stmt_bind_param($stmt4, "s", $status);
    mysqli_stmt_execute($stmt4);

    $rsd = mysqli_stmt_get_result($stmt4);

    if (mysqli_num_rows($rsd) > 0) {
        $result = true;
        $_SESSION["ps_status"] = $result;
    }
    mysqli_stmt_close($stmt4);

    $select = "SELECT * from hash JOIN user ON user.user_id = hash.user_id WHERE hash.h_email = ? AND hash.h_plate_num = ?";
    $stmt3 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt3, $select)) {
        header("location: ../signup_form.php?error=stmtfailed");
        exit();
    }
    $h_email = hash('sha256', $email);
    $h_plate_num = hash('sha256', $plate_num);
    mysqli_stmt_bind_param($stmt3, "ss", $h_email, $h_plate_num);
    mysqli_stmt_execute($stmt3);

    $result_Data = mysqli_stmt_get_result($stmt3);

    if (mysqli_num_rows($result_Data) > 0) {
        
        $rsp = mysqli_fetch_assoc($result_Data);
        $name = openssl_decrypt($rsp["name"], $method, $key, 0, $rsp["vi"]);
        $email = openssl_decrypt($rsp["email"], $method, $key, 0, $rsp["vi"]);
        $plate_num = openssl_decrypt($rsp["plate_num"], $method, $key, 0, $rsp["vi"]);
        $username = openssl_decrypt($rsp["username"], $method, $key, 0, $rsp["vi"]);
        $user_type = openssl_decrypt($rsp["user_type"], $method, $key, 0, $rsp["vi"]);

        $_SESSION["user_id"] = $rsp["user_id"];
        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;
        $_SESSION["plate_num"] = $plate_num;
        $_SESSION["username"] = $username;
        $_SESSION["user_type"] = $user_type;
        $_SESSION["credit_balance"] = $rsp["credit_balance"];
        
        mysqli_stmt_close($stmt1);
        mysqli_stmt_close($stmt2);
        mysqli_stmt_close($stmt3);
        if ($_SESSION["user_type"] === "admin") {
            header("location: ../dashboard_admin.php");
            mysqli_stmt_close($stmt1);
            mysqli_stmt_close($stmt2);
            exit();
        }
        elseif ($_SESSION["user_type"] === "user") {
            header("location: ../dashboard_user.php");
            mysqli_stmt_close($stmt1);
            mysqli_stmt_close($stmt2);
            exit();
        }
        elseif ($_SESSION["user_type"] === "security") {
            header("location: ../dashboard_security.php");
            mysqli_stmt_close($stmt1);
            mysqli_stmt_close($stmt2);
            exit();
        }
        elseif ($_SESSION["user_type"] === "accounting") {
            header("location: ../dashboard_accounting.php");
            mysqli_stmt_close($stmt1);
            mysqli_stmt_close($stmt2);
            exit();
        }
        exit();
    }
    else {
        mysqli_stmt_close($stmt);
        header("location: ../signup_form.php?error=registrationerror");
        exit();
    }
}

function add_user_username_Exist($conn, $username) {
    $select = "SELECT * FROM hash
    WHERE h_username = ?;";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $select)) {
        header("location: ../add_user.php?error=stmtfailed");
        exit();
    }
    $h_username = hash('sha256', $username);
    mysqli_stmt_bind_param($stmt, "s", $h_username);
    mysqli_stmt_execute($stmt);
    $result_Data = mysqli_stmt_get_result($stmt);

    if ($rsp = mysqli_fetch_assoc($result_Data)) {
        return $rsp;
    }
    else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function add_user_email_Exist($conn, $email) {
    $select = "SELECT * FROM hash
    WHERE h_email = ?;";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $select)) {
        header("location: ../add_user.php?error=stmtfailed");
        exit();
    }
    $h_email = hash('sha256', $email);
    mysqli_stmt_bind_param($stmt, "s", $h_email);
    mysqli_stmt_execute($stmt);

    $result_Data = mysqli_stmt_get_result($stmt);

    if ($rsp = mysqli_fetch_assoc($result_Data)) {
        return $rsp;
    }
    else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function add_user_plate_num_Exist($conn, $plate_num) {
    $select = "SELECT * FROM hash
    WHERE h_plate_num = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $select)) {
        header("location: ../add_user.php?error=stmtfailed");
        exit();
    }
    $plate_num = trim(preg_replace('/[^A-Za-z0-9]/', '', $plate_num));
    $h_plate_num = hash('sha256', $plate_num);
    mysqli_stmt_bind_param($stmt, "s", $h_plate_num);
    mysqli_stmt_execute($stmt);

    $result_Data = mysqli_stmt_get_result($stmt);

    if ($rsp = mysqli_fetch_assoc($result_Data)) {
        return $rsp;
    }
    else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

//add new user account
function add_User($conn, $name, $plate_num, $email, $username, $password, $user_type) {
    $insert1 = "INSERT INTO hash (h_email, h_plate_num, h_username, password)
    VALUES (?, ?, ?, ?);";
    $stmt1 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt1, $insert1)) {
        header("location: ../add_user.php?error=stmtfailed");
        exit();
    }
    $plate_num = trim(preg_replace('/[^A-Za-z0-9]/', '', $plate_num));
    $h_email = hash('sha256', $email);
    $h_plate_num = hash('sha256', $plate_num);
    $h_username = hash('sha256', $username);
    $pwd = hash('sha256', $password);

    mysqli_stmt_bind_param($stmt1, "ssss", $h_email, $h_plate_num,  $h_username, $pwd);
    mysqli_stmt_execute($stmt1);

    $insert2 = "INSERT INTO user (name, email, plate_num, username, credit_balance, vi,user_type)
    VALUES (?, ?, ?, ?, ?, ?, ?);";

    $stmt2 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt2, $insert2)) {
        header("location: ../signup_form.php?error=stmtfailed");
        exit();
    }
    
    $credit_balance = 0;
    require_once "encdec.inc.php";
    $enc_name= openssl_encrypt($name, $method, $key, 0, $iv);
    $enc_email= openssl_encrypt($email, $method, $key, 0, $iv);
    $enc_plate_num= openssl_encrypt($plate_num, $method, $key, 0, $iv);
    $enc_username= openssl_encrypt($username, $method, $key, 0, $iv);
    $enc_user_type= openssl_encrypt($user_type, $method, $key, 0, $iv);

    mysqli_stmt_bind_param($stmt2, "ssssiss", $enc_name, $enc_email, $enc_plate_num,  $enc_username, $credit_balance, $iv, $enc_user_type);
    mysqli_stmt_execute($stmt2);

    mysqli_stmt_close($stmt1);
    mysqli_stmt_close($stmt2);
    $_SESSION['message'] = "Account added successfully"; 
    header("location: ../manage_users.php?error=none");
    exit();
}

function update_user($conn, $name, $plate_num, $email, $username, $user_type, $e_user_id, $user_id) {
    $update1 = "UPDATE hash SET h_email = ?, h_plate_num = ?, h_username = ? WHERE user_id = ?;";

    $stmt1 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt1, $update1)) {
        header("location: ../edit_user.php?error=stmtfailed");
        exit();
    }
    
    $plate_num = trim(preg_replace('/[^A-Za-z0-9]/', '', $plate_num));
    $h_email = hash('sha256', $email);
    $h_plate_num = hash('sha256', $plate_num);
    $h_username = hash('sha256', $username);

    mysqli_stmt_bind_param($stmt1, "sssi", $h_email, $h_plate_num,  $h_username, $e_user_id);
    mysqli_stmt_execute($stmt1);
    
    $update2 = "UPDATE user SET name = ?, email = ?, plate_num = ?, username = ?, vi = ?, user_type = ? WHERE user_id = ?;";

    $stmt2 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt2, $update2)) {
        header("location: ../edit_user.php?error=stmtfailed");
        exit();
    }
    
    require_once "encdec.inc.php";
    $enc_name= openssl_encrypt($name, $method, $key, 0, $iv);
    $enc_email= openssl_encrypt($email, $method, $key, 0, $iv);
    $enc_plate_num= openssl_encrypt($plate_num, $method, $key, 0, $iv);
    $enc_username= openssl_encrypt($username, $method, $key, 0, $iv);
    $enc_user_type= openssl_encrypt($user_type, $method, $key, 0, $iv);
    mysqli_stmt_bind_param($stmt2, "ssssssi", $enc_name, $enc_email, $enc_plate_num,  $enc_username, $iv, $enc_user_type, $e_user_id);
    mysqli_stmt_execute($stmt2);

    $insert = "INSERT INTO digital_footprint (accessed_by, accessed_table, action_done, date_accessed, time_accessed) VALUES (?, ?, ?, CURRENT_DATE, CURRENT_TIME);";
    
    $accessed_table = "user and hash table";
    $action_done = "edit the information of user with an account# $e_user_id";

            $stmt3 = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt3, $insert)) {
                header("location: ../edit_user.php?error=stmtfailed");
                exit();
            }

            mysqli_stmt_prepare($stmt3,$insert);

            mysqli_stmt_bind_param($stmt3, "iss", $user_id, $accessed_table, $action_done);
            mysqli_stmt_execute($stmt3);

    mysqli_stmt_close($stmt1);
    mysqli_stmt_close($stmt2);
    mysqli_stmt_close($stmt3);

    header("location: ../manage_users.php?error=none");
    exit();
}

function delete_user($conn, $user_id, $except) {
    $select = "SELECT * FROM user WHERE user_id = ?;";
    $stmt1 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt1, $select)) {
        header("location: .. /manage_users.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt1, 's', $user_id);
    mysqli_stmt_execute($stmt1);

    $result_Data = mysqli_stmt_get_result($stmt1);
    include "encdec.inc.php";
        $rsp = mysqli_fetch_assoc($result_Data);
        $user_type = openssl_decrypt($rsp["user_type"], $method, $key, 0, $rsp["vi"]);
    
    if ($user_type != $except) {   
    $delete = "DELETE FROM user WHERE user_id = ?;";
    $stmt2 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt2, $delete)) {
        header("location: .. /manage_users.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt2, 'ss', $user_id, $except);

    mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt1);
    mysqli_stmt_close($stmt2);

    $_SESSION['message'] = "User deleted successfully"; 
    header('location: ../manage_users.php?error=none');
    exit(0);
    }
    else {
    $_SESSION['message'] = "You do not have the proper credential to delete this account."; 
    header('location: ../manage_users.php?error=none');
    exit(0);
    }
}

//functions for updating profile information
function update_profile_empty_Input($name, $plate_num, $username) {
    $result;
    if (empty($name) || empty($plate_num) || empty($username)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

//function for avoiding duplicate username
function update_profile_empty_input_ad_sec_acc($name,  $username) {
    $result;
    if (empty($name) || empty($username)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function update_profile_user($conn,$name, $plate_num, $email, $username, $user_type, $user_id) {
    $update1 = "UPDATE hash SET h_email = ?, h_plate_num = ?, h_username = ? WHERE user_id = ?;";

    $stmt1 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt1, $update1)) {
        header("location: ../edit_profile_user.php?error=stmtfailed");
        exit();
    }

    $stmt1 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt1, $update1)) {
        header("location: ../edit_profile_user.php?error=stmtfailed");
        exit();
    }

    $h_email = hash('sha256', $email);
    $h_plate_num = hash('sha256', $plate_num);
    $h_username = hash('sha256', $username);

    mysqli_stmt_bind_param($stmt1, "sssi", $h_email, $h_plate_num,  $h_username, $user_id);
    mysqli_stmt_execute($stmt1);

    include_once "encdec.inc.php";
    $enc_name= openssl_encrypt($name, $method, $key, 0, $iv);
    $enc_email= openssl_encrypt($email, $method, $key, 0, $iv);
    $enc_plate_num= openssl_encrypt($plate_num, $method, $key, 0, $iv);
    $enc_username= openssl_encrypt($username, $method, $key, 0, $iv);
    $enc_user_type= openssl_encrypt($user_type, $method, $key, 0, $iv);
    $update2 = "UPDATE user SET name = ?, email = ?, plate_num = ?, username = ?, vi = ?, user_type = ? WHERE user_id = ?;";

    $stmt2 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt2, $update2)) {
        header("location: ../edit_profile_user.php=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt2, "ssssssi", $enc_name, $enc_email, $enc_plate_num,  $enc_username, $iv, $enc_user_type, $user_id);
    mysqli_stmt_execute($stmt2);

    $update3 = "UPDATE vehicle_entry_log SET plate_num = ? WHERE user_id = ?";

    $stmt3 = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt3, $update3)) {
        header ("location: test7_signup.php");
        exit();
    }

    mysqli_stmt_bind_param($stmt3,"si", $h_plate_num, $user_id);
    mysqli_stmt_execute($stmt3);

    mysqli_stmt_close($stmt1);
    mysqli_stmt_close($stmt2);
    mysqli_stmt_close($stmt3);

    session_start();
    unset($_SESSION["name"]);
    unset($_SESSION["email"]);
    unset($_SESSION["username"]);
    unset($_SESSION["plate_num"]);
    $_SESSION["name"] = $name;
    $_SESSION["email"] = $email;
    $_SESSION["username"] = $username;
    $_SESSION["plate_num"] = $plate_num;

    header("location: ../profile_user.php?error=none");
    exit();
}


function update_profile_admin($conn,$name, $username, $user_type, $user_id) {
    $update1 = "UPDATE hash SET h_email = ?, h_plate_num = ?, h_username = ? WHERE user_id = ?;";

    $stmt1 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt1, $update1)) {
        header("location: ../profile_admin.php?error=stmtfailed");
        exit();
    }
    $plate_num = trim(preg_replace('/[^A-Za-z0-9]/', '', $plate_num));
    $h_email = hash('sha256', $email);
    $h_plate_num = hash('sha256', $plate_num);
    $h_username = hash('sha256', $username);

    mysqli_stmt_bind_param($stmt1, "sssi", $h_email, $h_plate_num,  $h_username, $user_id);
    mysqli_stmt_execute($stmt1);

    $update2 = "UPDATE user SET name = ?, email = ?, plate_num = ?, username = ?, vi = ?, user_type = ? WHERE user_id = ?;";

    $stmt2 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt2, $update2)) {
        header("location: ../profile_admin.php?error=stmtfailed");
        exit();
    }
    
    require_once "encdec.inc.php";
    $enc_name= openssl_encrypt($name, $method, $key, 0, $iv);
    $enc_email= openssl_encrypt($email, $method, $key, 0, $iv);
    $enc_plate_num= openssl_encrypt($plate_num, $method, $key, 0, $iv);
    $enc_username= openssl_encrypt($username, $method, $key, 0, $iv);
    $enc_user_type= openssl_encrypt($user_type, $method, $key, 0, $iv);

    mysqli_stmt_bind_param($stmt2, "ssssssi", $enc_name, $enc_email, $enc_plate_num,  $enc_username, $iv, $enc_user_type, $user_id);
    mysqli_stmt_execute($stmt2);

    mysqli_stmt_close($stmt1);
    mysqli_stmt_close($stmt2);

    session_start();
    $_SESSION["name"] = $name;
    $_SESSION["email"] = $email;
    $_SESSION["username"] = $username;
    $plate_num = trim(preg_replace('/[^A-Za-z0-9]/', '', $plate_num));
    $_SESSION["plate_num"] = $plate_num;

    header("location: ../profile_admin.php?error=none");
    exit();

}

function update_profile_accounting($conn,$name, $username, $user_type, $user_id) {
    $update1 = "UPDATE hash SET h_email = ?, h_plate_num = ?, h_username = ? WHERE user_id = ?;";

    $stmt1 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt1, $update1)) {
        header("location: ../profile_accounting.php?error=stmtfailed");
        exit();
    }
    $plate_num = trim(preg_replace('/[^A-Za-z0-9]/', '', $plate_num));
    $h_email = hash('sha256', $email);
    $h_plate_num = hash('sha256', $plate_num);
    $h_username = hash('sha256', $username);

    mysqli_stmt_bind_param($stmt1, "sssi", $h_email, $h_plate_num,  $h_username, $user_id);
    mysqli_stmt_execute($stmt1);

    $update2 = "UPDATE user SET name = ?, email = ?, plate_num = ?, username = ?, vi = ?, user_type = ? WHERE user_id = ?;";

    $stmt2 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt2, $update2)) {
        header("location: ../profile_accounting.php?error=stmtfailed");
        exit();
    }
    
    require_once "encdec.inc.php";
    $enc_name= openssl_encrypt($name, $method, $key, 0, $iv);
    $enc_email= openssl_encrypt($email, $method, $key, 0, $iv);
    $enc_plate_num= openssl_encrypt($plate_num, $method, $key, 0, $iv);
    $enc_username= openssl_encrypt($username, $method, $key, 0, $iv);
    $enc_user_type= openssl_encrypt($user_type, $method, $key, 0, $iv);

    mysqli_stmt_bind_param($stmt2, "ssssssi", $enc_name, $enc_email, $enc_plate_num,  $enc_username, $iv, $enc_user_type, $user_id);
    mysqli_stmt_execute($stmt2);

    mysqli_stmt_close($stmt1);
    mysqli_stmt_close($stmt2);

    session_start();
    $_SESSION["name"] = $name;
    $_SESSION["email"] = $email;
    $_SESSION["username"] = $username;
    $plate_num = trim(preg_replace('/[^A-Za-z0-9]/', '', $plate_num));
    $_SESSION["plate_num"] = $plate_num;

    header("location: ../profile_accounting.php?error=none");
    exit();

}

function update_profile_security($conn,$name, $plate_num, $email, $username, $user_type, $user_id) {
    $update1 = "UPDATE hash SET h_email = ?, h_plate_num = ?, h_username = ? WHERE user_id = ?;";

    $stmt1 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt1, $update1)) {
        header("location: ../profile_security.php?error=stmtfailed");
        exit();
    }
    $plate_num = trim(preg_replace('/[^A-Za-z0-9]/', '', $plate_num));
    $h_email = hash('sha256', $email);
    $h_plate_num = hash('sha256', $plate_num);
    $h_username = hash('sha256', $username);

    mysqli_stmt_bind_param($stmt1, "sssi", $h_email, $h_plate_num,  $h_username, $user_id);
    mysqli_stmt_execute($stmt1);

    $update2 = "UPDATE user SET name = ?, email = ?, plate_num = ?, username = ?, vi = ?, user_type = ? WHERE user_id = ?;";

    $stmt2 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt2, $update2)) {
        header("location: ../profile_security.php?error=stmtfailed");
        exit();
    }
    
    require_once "encdec.inc.php";
    $enc_name= openssl_encrypt($name, $method, $key, 0, $iv);
    $enc_email= openssl_encrypt($email, $method, $key, 0, $iv);
    $enc_plate_num= openssl_encrypt($plate_num, $method, $key, 0, $iv);
    $enc_username= openssl_encrypt($username, $method, $key, 0, $iv);
    $enc_user_type= openssl_encrypt($user_type, $method, $key, 0, $iv);

    mysqli_stmt_bind_param($stmt2, "ssssssi", $enc_name, $enc_email, $enc_plate_num,  $enc_username, $iv, $enc_user_type, $user_id);
    mysqli_stmt_execute($stmt2);

    mysqli_stmt_close($stmt1);
    mysqli_stmt_close($stmt2);

    session_start();
    $_SESSION["name"] = $name;
    $_SESSION["email"] = $email;
    $_SESSION["username"] = $username;
    $plate_num = trim(preg_replace('/[^A-Za-z0-9]/', '', $plate_num));
    $_SESSION["plate_num"] = $plate_num;

    header("location: ../profile_security.php?error=none");
    exit();

}

function empty_change_password($oc_password, $password, $c_password) {
    $result;
    if (empty($oc_password) || empty($password) || empty($c_password)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function current_password($conn, $user_id, $oc_password, $user_type) {
    $select = "SELECT * FROM hash
    WHERE user_id = ? AND password = ?;";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $select)) {
        if ($user_type == "user") {
            header("location: ../change_password_user.php?error=stmtfailed");
            exit();
        }
        elseif ($user_type == "employee") {
            header("location: ../change_password_employee.php?error=stmtfailed");
            exit();
        }
        elseif ($user_type == "admin") {
            header("location: ../change_password_admin.php?error=stmtfailed");
            exit();
        }
    }
    //oc_password = old/current password
    $h_oc_password = hash('sha256', $oc_password);

    mysqli_stmt_bind_param($stmt, "is", $user_id, $h_oc_password);
    mysqli_stmt_execute($stmt);

    $result_Data = mysqli_stmt_get_result($stmt); 

    if (mysqli_num_rows($result_Data) > 0) {
        $result = false;
        return $result;
    }
    else {
        $result = true;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function update_password($conn, $password, $user_id,$user_type) {
    $update = "UPDATE hash SET password =  ? WHERE user_id = ?;";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $update)) {
        if ($user_type == "user") {
            header("location: ../change_password_user.php?error=stmtfailed");
            exit();
        }
        elseif ($user_type == "security") {
            header("location: ../change_password_security.php?error=stmtfailed");
            exit();
        }
        elseif ($user_type == "admin") {
            header("location: ../change_password_admin.php?error=stmtfailed");
            exit();
        }
        elseif ($user_type == "accounting") {
            header("location: ../change_password_accounting.php?error=stmtfailed");
            exit();
        }
    }
    
    $pwd = hash('sha256', $password);

    mysqli_stmt_bind_param($stmt, "si", $pwd, $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($user_type == "user") {
        $_SESSION['message'] = "Password updated successfully"; 
        header("location: ../profile_user.php");
        exit();
    }
    elseif ($user_type == "security") {
        $_SESSION['message'] = "Password updated successfully"; 
        header("location: ../profile_security.php");
        exit();
    }
    elseif ($user_type == "admin") {
        $_SESSION['message'] = "Password updated successfully"; 
        header("location: ../profile_admin.php");
        exit();
    }
    elseif ($user_type == "accounting") {
        $_SESSION['message'] = "Password updated successfully"; 
        header("location: ../profile_accounting.php");
        exit();
    }
}

//functions for the credit top up system
function empty_InputTopup($tp_user_id, $tp_plate_num, $amount) {
    $result;
    if (empty($tp_user_id) OR empty($tp_plate_num) OR empty($amount)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function topup_credentials($conn, $tp_user_id, $tp_plate_num) {
    $select = "SELECT * FROM hash
    WHERE user_id = ? AND h_plate_num = ?;";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $select)) {
        header("location: ../top_up.php?error=transactionerror");
        exit();
    }
    $h_tp_plate_num = hash('sha256', $tp_plate_num);

    mysqli_stmt_bind_param($stmt, "is", $tp_user_id, $h_tp_plate_num);
    mysqli_stmt_execute($stmt);
    $result_data = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result_data) > 0) {
        $result = false;
        return $result;
    } else {
        $result = true;
        return $result;
    }
}

function add_credit($conn, $tp_user_id, $tp_plate_num, $amount) {
    $select = "SELECT * FROM hash
    WHERE user_id = ? AND h_plate_num = ?;";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $select)) {
        header("location: ../top_up.php?error=stmterror");
        exit();
    }
    $h_tp_plate_num = hash('sha256', $tp_plate_num);

    mysqli_stmt_bind_param($stmt, "is", $tp_user_id, $h_tp_plate_num);
    mysqli_stmt_execute($stmt);
    $result_data = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result_data) > 0) {
        $update = "UPDATE user
        JOIN hash ON user.user_id = hash.user_id
        SET user.credit_balance = user.credit_balance + ?
        WHERE user.user_id = ? AND hash.h_plate_num = ?;";

        $stmt1 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt1, $update)) {
            header("location: ../top_up.php?error=stmterror");
            exit();
        }
        $tp_plate_num = hash('sha256', $tp_plate_num);

        mysqli_stmt_bind_param($stmt1, "iis", $amount, $tp_user_id, $tp_plate_num);
        mysqli_stmt_execute($stmt1);

        $insert = "INSERT INTO credit_transactions (user_id, amount, transaction_date, transaction_time) VALUES (?, ?, CURRENT_DATE, CURRENT_TIME);";

            $stmt2 = mysqli_stmt_init($conn);

            mysqli_stmt_prepare($stmt2,$insert);
            mysqli_stmt_bind_param($stmt2, "ii", $tp_user_id, $amount);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_close($stmt1);
            mysqli_stmt_close($stmt2);

            session_start();
            $_SESSION["tp_message"] = "Transaction has been completed successfully.";
            header("location: ../top_up.php");
            exit();
    
    } 
    else {
    header("location: ../top_up.php?error=transactionerror");
    exit();
    }
}


//functions for payment system
function empty_password($password) {
    $result;
    if (empty($password)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function update_payment_system($conn, $payment_status, $password, $user_id) {
    $select = "SELECT * FROM hash WHERE user_id = ? AND password = ?";
    $stmt1 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt1, $select)) {
        header("location: ../payment_system.php?error=stmtfailed");
        exit();
    }
    $password= hash('sha256', $password);
    mysqli_stmt_bind_param($stmt1, "is", $user_id, $password);
    mysqli_stmt_execute($stmt1);
    $result = mysqli_stmt_get_result($stmt1);

    if (mysqli_num_rows($result) > 0) {
    
        $update = "UPDATE payment_system SET status = ?  WHERE id = 1";
        $stmt2 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt2, $update)) {
            header("location: ../payment_system.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt2, "s", $payment_status);
        mysqli_stmt_execute($stmt2);

        $insert = "INSERT INTO digital_footprint (accessed_by, accessed_table, action_done, date_accessed, time_accessed) VALUES (?, ?, ?, CURRENT_DATE, DATE_ADD(CURRENT_TIME(), INTERVAL 8 HOUR));";
    
        $accessed_table = "payment_system";
        $action_done = "edit the payment status";

                $stmt3 = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt3, $insert)) {
                    header("location: ../payment_system.php?error=stmtfailed");
                    exit();
                }

                mysqli_stmt_prepare($stmt3,$insert);
    
                mysqli_stmt_bind_param($stmt3, "iss", $user_id, $accessed_table, $action_done);
                mysqli_stmt_execute($stmt3);
    
        mysqli_stmt_close($stmt1);
        mysqli_stmt_close($stmt2);
        mysqli_stmt_close($stmt3);
        session_start();
        unset($_SESSION["ps_status"]);
        $_SESSION["ps_status"] = $payment_status;
        header("location: ../dashboard_admin.php?error=none");
        exit();

    }
    else {
        header("location: ../payment_system.php?error=pwdincorrect");
        exit();
    }
    

}


//functions for filtering table results
function no_date1($date1) {
    $result;
    if (empty($date1)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function no_time($date1, $date2, $time1, $time2) {
    $result;
    if (!empty($date1) && empty($date2) && !empty($time1) && empty($time2)) {
        $result = true;
    }
    elseif (!empty($date1) && empty($date2) && empty($time1) && !empty($time2)) {
        $result = true;
    }
    elseif (!empty($date1) && !empty($date2) && !empty($time1) && empty($time2)) {
        $result = true;
    }
    
    elseif (!empty($date1) && !empty($date2) && empty($time1) && !empty($time2)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

