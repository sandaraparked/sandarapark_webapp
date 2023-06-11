<?PHP

if (isset($_POST["update_profile-accounting"])) {
    $user_type = $_POST["user_type"];
    $user_id = $_POST["user_id"];
    $name = $_POST["name"];
    $plate_num = $_POST["plate_num"];
    $email = $_POST["email"];
    $username = $_POST["username"];

    
    require_once 'dbhed.inc.php';
    require_once 'functioneds.inc.php';

    //error handlers
    //update_profile_empty_input_ad_sec_acc  = update_profile_empty_input_admin_security_accounting
    if (update_profile_empty_input_ad_sec_acc($name, $username) !== false) {
        header("location: ../edit_profile_accounting.php?error=emptyinput");
        exit();
    }


    if (invalid_Username($username) !== false) {
        header("location: ../edit_profile_accounting.php?error=invalidusername");
        exit();
    }

    // if (invalid_Email($email) !== false) {
    //     header("location: ../edit_profile_admin.php?error=invalidemil");
    //     exit();
    // }

    update_profile_accounting($conn,$name, $username, $user_type, $user_id);
}

else { 
    header("location: ../edit_profile_accounting.php");
    exit();
}


