<?PHP

if (isset($_POST["update_user"])) {
    session_start();
    $e_user_id = $_POST["e_user_id"];
    $user_id = $_SESSION["user_id"];
    $name = $_POST["name"];
    $plate_num = $_POST["plate_num"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $user_type = $_POST["user_type"];

    require_once 'dbhed.inc.php';
    require_once 'functioneds.inc.php';

    //error handlers

    //checks if all the input fields are filled
    if (empty_Input_update($name, $plate_num, $email, $username) !== false) {
        header("location: ../edit_user.php?error=emptyinput");
        exit();
    }

    //checks if the user type in a valid username
    if (invalid_Username($username) !== false) {
        header("location: ../edit_user.php?error=invalidusername");
        exit();
    }

    //check it the user type in a valid email
    if (invalid_Email($email) !== false) {
        header("location: ../edit_user.php?error=invalidemil");
        exit();
    }


    update_user($conn, $name, $plate_num, $email, $username, $user_type, $e_user_id, $user_id );
}
else {
    header("location: ../edit_user.php");
    exit();
}
