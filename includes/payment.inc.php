<?PHP
if (isset($_POST["unparkpay"])) {
    session_start();
    require_once 'dbhed.inc.php';
    require_once 'functioneds.inc.php';
    $user_id = $_POST["user_id"];
    $amount_due = $_POST["amount_due"];
//    $plate_num = $_SESSION["plate_num"];

    $update = "UPDATE user
    SET user.credit_balance = user.credit_balance - ?
    WHERE user.user_id = ?;;";

    $stmt1 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt1, $update)) {
        header("location: ../ticket.php?error=stmterror");
        exit();
    }

    mysqli_stmt_bind_param($stmt1, "ii", $amount_due, $user_id);
    mysqli_stmt_execute($stmt1);
    mysqli_stmt_close($stmt1);

        $_SESSION["credit_balance"] = $_SESSION["credit_balance"] - $amount_due;
        header("location: ../dashboard_user.php?error=none");
    echo"error 1"; 

    }
?>