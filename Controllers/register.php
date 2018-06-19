<?php

session_start();

/*var_dump($_POST["password"]);
var_dump($_POST["confirmed_password"]);

exit();*/

#we verify the password and the confirmed_password match. If not we redirect the user back
if ($_POST["password"] != $_POST["confirmed_password"]) {
    
    $_SESSION["ERROR_MSG"] = "Your password isn't confirmed well. Please try again.";
    header("Location: ../Views/login.php");
    return;
    
}

include('HelperClasses/connection.php');
$conn = OracleConnection::getConnection();

$username = $_POST["username"];
$password = $_POST["password"];
$email = $_POST["email"];
$is_admin = 0;
$created_at = date('d-m-Y h:i:s', strtotime("now"));

#we verify if the username already exists
$is_username_used = oci_parse($conn, 'SELECT COUNT(*) FROM USERS WHERE username = :username');
oci_bind_by_name($is_username_used, ':username', $username);
oci_execute($is_username_used);

if ($row = oci_fetch_array($is_username_used, OCI_BOTH)) {
    
    oci_free_statement($is_username_used);
    
    if ($row[0] != 0) {
        
        $_SESSION["ERROR_MSG"] = "Username already exists. Please try another one.";
        header("Location: ../Views/login.php");
        return;
        
    }
    
}


#we verify if the email already exists
$is_email_used = oci_parse($conn, 'SELECT COUNT(*) FROM USERS WHERE email = :email');
oci_bind_by_name($is_email_used, ':email', $email);
oci_execute($is_email_used);

if ($row = oci_fetch_array($is_email_used, OCI_BOTH)) {
    
    oci_free_statement($is_email_used);
    
    if ($row[0] != 0) {
        
        $_SESSION["ERROR_MSG"] = "Email already in use. Please try another one.";
        header("Location: ../Views/login.php");
        return;
        
    }
    
}




#we insert the new user into the USERS table
$register_user = oci_parse($conn, 'INSERT INTO USERS VALUES(null, :username, :password, :email, :is_admin, to_date(:created_at, \'DD-MM-YYYY HH24:MI:SS\'))');
oci_bind_by_name($register_user, ':username', $username);
oci_bind_by_name($register_user, ':password', $password);
oci_bind_by_name($register_user, ':email', $email);
oci_bind_by_name($register_user, ':is_admin', $is_admin);
oci_bind_by_name($register_user, ':created_at', $created_at);

oci_execute($register_user);

oci_free_statement($register_user);

$_SESSION["SUCCESS_MSG"] = "New Account Created!";
header("Location: ../Views/login.php");

?>