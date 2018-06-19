<?php 

        if ( $_SESSION["Auth_is_admin"] == 1){
            $user_info = oci_parse($conn, 'SELECT * FROM PETITII');
            oci_execute($user_info);
            $results_reports = array();
            
            while($row = oci_fetch_array($user_info, OCI_BOTH)) {
                
                array_push($results_reports, $row);
                
            }

            oci_free_statement($user_info);
        }

 ?>