<?PHP
if (isset($_POST["signup_submit"])) {
    $name = $_POST["name"];
    $c_plate_num = $_POST["plate_num"];
    $plate_num = trim(preg_replace('/[^A-Za-z0-9]/', '', $c_plate_num));
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password= $_POST["password"];
    $c_password = $_POST["c_password"];

    require_once 'dbhed.inc.php';
    require_once 'functioneds.inc.php';


    //error handlers

    //check if the checkbox for consent is checked.
    if (!isset($_POST['consent'])) {
        header("location: ../signup_form.php?error=consent");
    }

    if (empty_Input_Signup($name, $plate_num, $username, $password, $c_password) !== false) {
        header("location: ../signup_form.php?error=emptyinput");
        exit();
    }

    if (invalid_Username($username) !== false) {
        header("location: ../signup_form.php?error=invalidusername");
        exit();
    }
    
    //check it the user type in a valid email
    // if (invalid_Email($email) !== false) {
    //     header("location: ../signup_form.php?error=invalidemil");
    //     exit();
    // }

    //confirms if the user typed in matching password
    if (password_Match($password, $c_password) !== false) {
        header("location: ../signup_form.php?error=passwordsdontmatch");
        exit();
    }

    if (signup_username_Exist($conn, $username) !== false) {
        header("location: ../signup_form.php?error=usernametaken");
        exit();
    }

    //checks if the email already exist in the database
    // if (signup_email_Exist($conn, $email) !== false) {
    //     header("location: ../signup_form.php?error=emailtaken");
    //     exit();
    // }

    if (signup_plate_num_Exist($conn, $plate_num) !== false) {
        header("location: ../signup_form.php?error=platenumtaken");
        exit();
    }

    create_User($conn, $name, $plate_num, $email, $username, $password);
}
else {
    header("location: ../signup_form.php");
    exit();
}

