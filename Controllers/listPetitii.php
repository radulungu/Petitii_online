<?php     
        include('HelperClasses/connection.php');
        $conn = OracleConnection::getConnection();
        
        $denumire_petitie = "";
        $domeniu = "";
        $margine_inferioara = 0;
        $margine_superioara = 1000000;

        if (isset($_GET['denumire_petitie'])) {
            $denumire_petitie = $_GET['denumire_petitie'];
        }
        if (isset($_GET['domeniu'])) {
            if ($_GET['domeniu'] != "All") {
                
                $domeniu = ucfirst($_GET['domeniu']);
                
            }
        }

        if (isset($_GET['interval']) && $_GET['interval']=="0-5.000") {
            $margine_inferioara = 0;
            $margine_superioara = 5000;
        }
        if (isset($_GET['interval']) && $_GET['interval']=="5.000-10.000") {
            $margine_inferioara = 5000;
            $margine_superioara = 10000;
        }
        if (isset($_GET['interval']) && $_GET['interval']=="10.000-50.000") {
            $margine_inferioara = 10000;
            $margine_superioara = 50000;
        }
        if (isset($_GET['interval']) && $_GET['interval']=="50.000-100.000") {
            $margine_inferioara = 50000;
            $margine_superioara = 100000;
        }
        if (isset($_GET['interval']) && $_GET['interval']=="100.000-1.000.000") {
            $margine_inferioara = 100000;
            $margine_superioara = 1000000;
        }

        /*var_dump($denumire_petitie);
        var_dump($domeniu);
        var_dump($margine_inferioara);
        var_dump($margine_superioara);
        exit();*/
        
        $stmt = 'SELECT * FROM PETITII WHERE id NOT IN (SELECT p.id FROM PETITII p LEFT JOIN SUPPORTERS s on p.id=s.Petitie_ID WHERE p.CREATOR_ID = :user_id OR s.USER_ID = :user_id) AND numar_semnaturi>=:margine_inferioara AND numar_semnaturi<=:margine_superioara';
        
        /*var_dump($stmt);
        exit();*/
            
        $has_denumire = false;
        $has_domeniu = false;
        
        if ($denumire_petitie != "") {
            
            $stmt = $stmt . ' AND regexp_like(name, :denumire_petitie)';
            $has_denumire = true;
            
        }
        
        if ($domeniu != "") {
            
            $stmt = $stmt . ' AND regexp_like(domeniu, :domeniu)';
            $has_domeniu = true;
            
        }
        
        /*var_dump($stmt);
        exit();*/
        
        $petition_select = oci_parse($conn, $stmt);
        oci_bind_by_name($petition_select, ':margine_inferioara', $margine_inferioara);
        oci_bind_by_name($petition_select, ':margine_superioara', $margine_superioara);
        oci_bind_by_name($petition_select, ':user_id', $_SESSION['Auth_id']);
        if($has_denumire) {
           
            oci_bind_by_name($petition_select, ':denumire_petitie', $denumire_petitie);
            
        }
        
        if($has_domeniu) {
            
            oci_bind_by_name($petition_select, ':domeniu', $domeniu);
            
        }
        
        oci_execute($petition_select); 
        
        $results = array();
        
        while($row = oci_fetch_array($petition_select, OCI_BOTH)) {
            
            #var_dump($row);
            array_push($results, $row);
            
        }

        oci_free_statement($petition_select);
        

?>
        