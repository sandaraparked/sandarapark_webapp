<?PHP
if (isset($_POST["change_password-user"])) {
    $user_id = $_POST["user_id"];
    $user_type = $_POST["user_type"];
    $oc_password = $_POST["oc_password"];
    $password= $_POST["password"];
    $c_password = $_POST["c_password"];

    require_once 'dbhed.inc.php';
    require_once 'functioneds.inc.php';

    //error handlers
    if (empty_change_password($oc_password, $password, $c_password) !== false) {
        header("location: ../change_password_user.php?error=emptyinput");
        exit();
    }

    //checks if the current password is correct
    if (current_password($conn, $user_id, $oc_password, $user_type) !== false) {
        header("location: ../change_password_user.php?error=incorrectpassword");
        exit();
    }

    //confirms if the user typed in matching (new) password
    if (password_Match($password, $c_password) !== false) {
        header("location: ../change_password_user.php?error=passwordsdontmatch");
        exit();
    }

    update_password($conn, $password, $user_id, $user_type);
}
elseif (isset($_POST["change_password-admin"])) {
    $user_id = $_POST["user_id"];
    $user_type = $_POST["user_type"];
    $oc_password = $_POST["oc_password"];
    $password= $_POST["password"];
    $c_password = $_POST["c_password"];


    require_once 'dbhed.inc.php';
    require_once 'functioneds.inc.php';

    //error handlers
    if (empty_change_password($oc_password, $password, $c_password) !== false) {
        header("location: ../change_password_admin.php?error=emptyinput");
        exit();
    }

    //confirms if the user typed in matching (new) password
    if (password_Match($password, $c_password) !== false) {
        header("location: ../change_password_admin.php?error=passwordsdontmatch");
        exit();
    }

    //checks if the typed in current password is correct
    if (current_password($conn, $user_id, $oc_password, $user_type) !== false) {
        header("location: ../change_password_admin.php?error=incorrectpassword");
        exit();
    }
    update_password($conn, $password, $user_id, $user_type);
}

elseif (isset($_POST["change_password-security"])) {
    $user_id = $_POST["user_id"];
    $user_type = $_POST["user_type"];
    $oc_password = $_POST["oc_password"];
    $password= $_POST["password"];
    $c_password = $_POST["c_password"];


    require_once 'dbhed.inc.php';
    require_once 'functioneds.inc.php';

    //error handlers
    if (empty_change_password($oc_password, $password, $c_password) !== false) {
        header("location: ../change_password_security.php?error=emptyinput");
        exit();
    }

    //confirms if the user typed in matching (new) password
    if (password_Match($password, $c_password) !== false) {
        header("location: ../change_password_security.php?error=passwordsdontmatch");
        exit();
    }

    //checks if the current password is correct
    if (current_password($conn, $user_id, $oc_password, $user_type) !== false) {
        header("location: ../change_password_security.php?error=incorrectpassword");
        exit();
    }
    update_password($conn, $password, $user_id, $user_type);
}

elseif (isset($_POST["change_password-accounting"])) {
    $user_id = $_POST["user_id"];
    $user_type = $_POST["user_type"];
    $oc_password = $_POST["oc_password"];
    $password= $_POST["password"];
    $c_password = $_POST["c_password"];


    require_once 'dbhed.inc.php';
    require_once 'functioneds.inc.php';

    //error handlers
    if (empty_change_password($oc_password, $password, $c_password) !== false) {
        header("location: ../change_password_accounting.php?error=emptyinput");
        exit();
    }

    //confirms if the user typed in matching (new) password
    if (password_Match($password, $c_password) !== false) {
        header("location: ../change_password_accounting.php?error=passwordsdontmatch");
        exit();
    }

    //checks if the current password is correct
    if (current_password($conn, $user_id, $oc_password, $user_type) !== false) {
        header("location: ../change_password_accounting.php?error=incorrectpassword");
        exit();
    }
    update_password($conn, $password, $user_id, $user_type);
}

else {
    $user_id = $_POST["user_id"];
    $user_type = $_POST["user_type"];
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
