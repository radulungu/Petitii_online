<?php

require "check_auth.php";

include('../Controllers/HelperClasses/connection.php');
$conn = OracleConnection::getConnection();

/*var_dump($_GET["petitie_id"]);
exit();*/

$delete_signature = oci_parse($conn, 'DELETE FROM SUPPORTERS WHERE USER_ID = :user_id AND petitie_id = :petitie_id');
oci_bind_by_name($delete_signature, ':user_id', $_SESSION["Auth_id"]);
oci_bind_by_name($delete_signature, ':petitie_id', $_GET["petitie_id"]);
oci_execute($delete_signature);

$decrement_numar_semnaturi = oci_parse($conn, 'UPDATE PETITII SET NUMAR_SEMNATURI = NUMAR_SEMNATURI - 1 WHERE ID = :petitie_id');
oci_bind_by_name($decrement_numar_semnaturi, ':petitie_id', $_GET["petitie_id"]);
oci_execute($decrement_numar_semnaturi);

header("Location: ../Views/logged.php");

?>