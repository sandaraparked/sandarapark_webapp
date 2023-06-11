<?PHP
//for edit-profile-user
if (isset($_POST["update_profile-user"])) {
    $user_id = $_POST["user_id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $plate_num = $_POST["plate_num"];
    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //error handlers
    if (empty_Input_Signup1($name, $email, $username,$plate_num) !== false) {
        header("location: ../edit_profile_user.php?error=emptyinput");
        exit();
    }

    if (invalid_Username($username) !== false) {
        header("location: ../edit_profile_user.php?error=invalidusername");
        exit();
    }
    //check it the user type in a valid email
    if (invalid_Email($email) !== false) {
        header("location: ../edit_profile_user.php?error=invalidemil");
        exit();
    }

    update_profile_user($conn,$name, $plate_num, $email, $username, $user_type, $user_id);
}
else { 
    header("location: ../edit_profile_user.php");
    exit();
}



//for edit-profile-admin
if (isset($_POST["update_profile-admin"])) {
    $user_id = $_POST["user_id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $plate_num = $_POST["plate_num"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //error handlers

    //checks if all the input fields are filled
    if (empty_Input_Signup($name, $plate_num, $username, $password, $c_password)!== false) {
        header("location: ../edit_profile_admin.php?error=emptyinput");
        exit();
    }

    //checks if the user type in a valid username
    if (invalid_Username($username) !== false) {
        header("location: ../edit_profile_admin.php?error=invalidusername");
        exit();
    }

    //check it the user type in a valid email
    if (invalid_Email($email) !== false) {
        header("location: ../edit_profile_admion.php?error=invalidemil");
        exit();
    }


    update_profile_admin($conn,$name, $plate_num, $email, $username, $user_id);
}
else { 
    header("location: ../edit_profile_admin.php");
    exit();
}


//for edit-profile-security
if (isset($_POST["update_profile-employee"])) {
    $user_id = $_POST["user_id"];
    $name = $_POST["name"];
    $plate_num = $_POST["plate_num"];
    $email = $_POST["email"];
    $username = $_POST["username"];

    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //error handlers

    //checks if all the input fields are filled
    if (update_profile_empty_Input($name, $email, $username,$plate_num) !== false) {
        header("location: ../edit_profile_employee.php?error=emptyinput");
        exit();
    }

    //checks if the user type in a valid username
    if (invalid_Username($username) !== false) {
        header("location: ../edit_profile-employee.php?error=invalidusername");
        exit();
    }

    //check it the user type in a valid email
    if (invalid_Email($email) !== false) {
        header("location: ../edit_profile_employee.php?error=invalidemil");
        exit();
    }

    update_profile_security($conn,$name, $plate_num, $email, $username, $user_type, $user_id);
}

else { 
    header("location: ../edit_profile_employee.php");
    exit();
}
