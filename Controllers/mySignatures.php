<?php     
        //session_start();

        //in cazul in care esti user , procesarea de date se va face aici si afisarea in view
        $user_info = oci_parse($conn, 'SELECT p.* FROM PETITII p JOIN SUPPORTERS s ON p.Id = s.Petitie_id JOIN USERS u ON u.Id = s.User_id 
            WHERE u.ID = :user_id   ');

        oci_bind_by_name($user_info, ':user_id', $_SESSION["Auth_id"]);

        oci_execute($user_info);

        $results_signatures = array();
        
        while($row = oci_fetch_array($user_info, OCI_BOTH)) {
            
            #var_dump($row);
            array_push($results_signatures, $row);
            
        }
        oci_free_statement($user_info);

      function scoateSemnatura($Petitie_id,$user_id){
            $user_info = oci_parse($conn, 'DELETE FROM SUPPORTERS WHERE USER_ID = :user_id AND PETITIE_ID = :petitie_id');
            oci_bind_by_name($user_info, ':user_id', $user_id);
            oci_bind_by_name($user_info, ':petitie_id', $Petitie_id);
            header("Location: ../Views/acasa.php");
      }
?>

