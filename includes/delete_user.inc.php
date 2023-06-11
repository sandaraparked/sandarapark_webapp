<?PHP
if (isset($_POST["delete_user"])) {
    $user_id = $_POST["user_id"];
    $except = "user";

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    delete_user($conn, $user_id, $except);
}

else {
    header("location: ../manager_users.php");
    exit();
}