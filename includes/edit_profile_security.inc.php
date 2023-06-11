<?PHP
if (isset($_POST["update_profile-security"])) {
    $user_id = $_POST["user_id"];
    $user_type = $_POST["user_type"];
    $name = $_POST["name"];
    $plate_num = $_POST["plate_num"];
    $email = $_POST["email"];
    $username = $_POST["username"];

    
    require_once 'dbhed.inc.php';
    require_once 'functioneds.inc.php';

    //error handlers
    //checks if all the input fields are filled
    //update_profile_empty_input_ad_sec_acc  = update_profile_empty_input_admin_security_accounting
    if (update_profile_empty_input_ad_sec_acc($name, $username) !== false) {
        header("location: ../edit_profile_security.php?error=emptyinput");
        exit();
    }

    if (invalid_Username($username) !== false) {
        header("location: ../edit_profile_security.php?error=invalidusername");
        exit();
    }

    // //check it the user type in a valid email
    // if (invalid_Email($email) !== false) {
    //     header("location: ../edit_profile_employee.php?error=invalidemil");
    //     exit();
    // }


    update_profile_security($conn,$name, $plate_num, $email, $username, $user_type,$user_id);
    
}

else { 
    header("location: ../edit_profile_security.php");
    exit();
}


