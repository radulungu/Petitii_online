<?php

require "check_auth.php";

include('../Controllers/HelperClasses/connection.php');
$conn = OracleConnection::getConnection();

/*var_dump($_GET["petitie_id"]);
exit();*/

/*var_dump($date);
exit();*/

$add_signature = oci_parse($conn, 'INSERT INTO SUPPORTERS VALUES (null, :user_id, :petitie_id)');
oci_bind_by_name($add_signature, ':user_id', $_SESSION["Auth_id"]);
oci_bind_by_name($add_signature, ':petitie_id', $_GET["petitie_id"]);
oci_execute($add_signature);
header("Location: ../Views/lista_petitii.php");
	
?>