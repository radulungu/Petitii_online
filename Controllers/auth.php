<?php

session_start();

#we get the user's id if they exist in our DB and 0 otherwise
#echo $_POST["username"];
#echo $_POST["password"];
$result = getUser($_POST["username"], $_POST["password"]);
$_SESSION["Auth_id"] = $result["id"];
$_SESSION["Auth_is_admin"] = $result["is_admin"];
$_SESSION["Auth_name"] = $result["username"];
/*var_dump($_SESSION["Auth_id"]);
var_dump($_SESSION["Auth_name"]);
exit();*/
if ($_SESSION["Auth_id"] == 0) {
    
    $_SESSION["ERROR_MSG"] = "The username or password aren't correct. Please try again.";
    header("Location: ../Views/login.php");
    
} else {

    header("Location: ../Views/logged.php");
    
}
   

function getUser($username, $password) {
    
    include('HelperClasses/connection.php');
    $conn = OracleConnection::getConnection();
    
    $search_user = oci_parse($conn, 'SELECT id, is_admin, username FROM USERS WHERE username = :username AND password = :password');
    oci_bind_by_name($search_user, ':username', $username);
    oci_bind_by_name($search_user, ':password', $password);
   
    oci_execute($search_user);
    
    $result = null;
    
    if ($row = oci_fetch_array($search_user, OCI_BOTH)) {
        
        $result = array("id" => $row[0], "is_admin" => $row[1], "username" => $row[2]);
        
    }
    else {
        
        $result = array("id" => 0, "is_admin" => 0, "username" => "");
        
    }
    
    /*var_dump($result);
    exit();*/
    
    oci_free_statement($search_user);
    
    return $result;
    
}


?>

