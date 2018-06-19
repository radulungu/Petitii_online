<?php

require "check_auth.php";

include('../Controllers/HelperClasses/connection.php');
$conn = OracleConnection::getConnection();

$delete_petition = oci_parse($conn, 'DELETE FROM PETITII WHERE id = :petitie_id');
oci_bind_by_name($delete_petition, ':petitie_id', $_GET["petitie_id"]);
oci_execute($delete_petition);
header("Location: ../Views/logged.php");

?>