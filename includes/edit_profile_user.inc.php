<?PHP
if (isset($_POST["update_profile-user"])) {
    $user_id = $_POST["user_id"];
    $user_type = $_POST["user_type"];
    $name = $_POST["name"];
    $plate_num = trim(preg_replace('/[^A-Za-z0-9]/', '', $_POST["plate_num"]));
    $email = $_POST["email"];
    $username = $_POST["username"];
    
    
    require_once 'dbhed.inc.php';
    require_once 'functioneds.inc.php';

    //error handlers

    if (update_profile_empty_Input($name, $username,$plate_num) !== false) {
        header("location: ../edit_profile_user.php?error=emptyinput");
        exit();
    }

    if (invalid_Username($username) !== false) {
        header("location: ../edit_profile_user.php?error=invalidusername");
        exit();
    }

    //check it the user type in a valid email
    // if (invalid_Email($email) !== false) {
    //     header("location: ../edit_profile_user.php?error=invalidemil");
    //     exit();
    // }
    update_profile_user($conn,$name, $plate_num, $email, $username, $user_type, $user_id);
}

else { 
    header("location: ../edit_profile_user.php");
    exit();
}


