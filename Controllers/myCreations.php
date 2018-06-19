<?php     
        #session_start();
       
        $user_info = oci_parse($conn, 'SELECT p.* FROM PETITII p JOIN CREATOR c ON p.Id = c.Petitie_id JOIN USERS u ON u.Id = c.User_id 
            WHERE u.ID = :user_id   ');

        oci_bind_by_name($user_info, ':user_id', $_SESSION["Auth_id"]);

        oci_execute($user_info);

        $results_creations = array();
        
        while($row = oci_fetch_array($user_info, OCI_BOTH)) {
            
            #var_dump($row);
            array_push($results_creations, $row);
            
        }
        oci_free_statement($user_info);

        function deletePetition($Petitie_id,$user_id) {
            include('HelperClasses/connection.php');
            $conn = OracleConnection::getConnection();
          
            $user_info = oci_parse($conn, 'DELETE FROM PETITII WHERE CREATOR_ID = :user_id AND ID = :petitie_id');
            oci_bind_by_name($user_info, ':user_id', $user_id);
            oci_bind_by_name($user_info, ':petitie_id', $Petitie_id);
            oci_execute($user_info);
            header("Location: ../Views/acasa.php");
      }
?>

