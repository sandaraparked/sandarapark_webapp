<?PHP
if (isset($_POST["add_user"])) {
    $name = $_POST["name"];
    $plate_num = $_POST["plate_num"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $user_type = $_POST["user_type"];
    $password= $_POST["password"];
    $c_password = $_POST["c_password"];

    require_once 'dbhed.inc.php';
    require_once 'functioneds.inc.php';

    //error handlers
    //addu = add user
    if (empty_input_addu($name, $username, $password, $c_password) !== false) {
        header("location: ../add_user.php?error=emptyinput");
        exit();
    }

    if (invalid_Username($username) !== false) {
        header("location: ../add_user.php?error=invalidusername");
        exit();
    }

    //check it the user type in a valid email
    // if (invalid_Email($email) !== false) {
    //     header("location: ../add_user.php?error=invalidemil");
    //     exit();
    // }

    //confirms if the user typed in matching (new) password
    if (password_Match($password, $c_password) !== false) {
        header("location: ../add_user.php?error=passwordsdontmatch");
        exit();
    }
    
    if (add_user_username_Exist($conn, $username) !== false) {
        header("location: ../add_user.php?error=usernametaken");
        exit();
    }

    // if (add_user_email_Exist($conn, $email) !== false) {
    //     header("location: ../add_user.php?error=emailtaken");
    //     exit();
    // }

    //checks if the plate number already exist in the database
    // if (add_user_plate_num_Exist($conn, $plate_num) !== false) {
    //     header("location: ../add_user.php?error=platenumtaken");
    //     exit();
    // }
    
    //creates the new user if there are no errors
    add_User($conn,$name, $plate_num, $email, $username, $password, $user_type);
}
else {
    header("location: ../add_user.php");
    exit();
}