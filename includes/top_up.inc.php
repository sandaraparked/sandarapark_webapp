<?PHP
if (isset($_POST["submit_check"])) {
    $tp_user_id = $_POST["tp_user_id"];
    $tp_plate_num = $_POST["tp_plate_num"];
    $amount = $_POST["amount"];
    
    require_once 'dbhed.inc.php';
    require_once 'functioneds.inc.php';

    //error handlers
    if (empty_InputTopup($tp_user_id, $tp_plate_num, $amount) !== false) {
        header("location: ../top_up.php?error=emptyinput");
        exit();
    }

    if (topup_credentials($conn, $tp_user_id, $tp_plate_num) !== false) {
        header("location: ../top_up.php?error=wrongcredentials");
        exit();
    }

    session_start();
    $_SESSION["tp_user_id"] = $tp_user_id;
    $_SESSION["tp_plate_num"] = $tp_plate_num;
    $_SESSION["amount"] = $amount;
    header("location:../top_up_confirm.php");

}

if (isset($_POST["confirm"])) {
    session_start();
    $tp_user_id = $_SESSION["tp_user_id"];
    $tp_plate_num = $_SESSION["tp_plate_num"];
    $amount = $_SESSION["amount"];

    require_once 'dbhed.inc.php';
    require_once 'functioneds.inc.php';

    //error handlers
    add_credit($conn, $tp_user_id, $tp_plate_num, $amount);
}
?>