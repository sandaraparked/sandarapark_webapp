<?PHP
if (isset($_POST["update_payment_system"])) {
    session_start();
    $user_id = $_POST["user_id"];
    $payment_status= $_POST["payment_status"];
    $password = $_POST["password"];

    require_once 'dbhed.inc.php';
    require_once 'functioneds.inc.php';

    //error handlers
    if (empty_password($password) !== false) {
        header("location: ../payment_system.php?error=nopassword");
        exit();
    }
    update_payment_system($conn, $payment_status, $password, $user_id );
}
else {
    header("location: ../payment_system.php");
    exit();
 }
