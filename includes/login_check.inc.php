<?PHP
if (isset($_POST["submit"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];
    
    require_once 'dbhed.inc.php';
    require_once 'functioneds.inc.php';

    //error handlers
    if (empty_InputLogin($username, $password) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    login($conn, $username, $password);
}
else {
    header("location:../login.php");
    exit();
}