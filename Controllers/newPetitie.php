<?php     

        require "check_auth.php";

        /*functia construct_exp_date ia o data in format yyyy-mm-dd si o transforma intr-o data
        de tip dd-mm-yyyy hh-mm-ss astfel incat sa avem un format acceptat de baza de date*/
        function construct_exp_date($date) {
            
            $components = explode("-", $date);
            
            $newDate = $components[2] . '-' . $components[1] . '-' . $components[0] . " 00:00:00";
         
            return $newDate;
            
        }

        include('HelperClasses/connection.php');
        $conn = OracleConnection::getConnection();

        /*var_dump($_GET['denumire_petitie']);
        var_dump($_GET['domeniu']);
        var_dump($_GET['data_expirare']);
        var_dump($_GET['descriere']);
        exit();*/
        
        $creator_id = $_SESSION["Auth_id"]; /*creator_id va fi implicit odata ce ne ocupam si de autentificare :D*/
        $numar_semnaturi = 0; /*cand creezi o noua petitie aceasta are 0 semnaturi*/
        $created_at = date('d-m-Y h:i:s', strtotime("now")); /*petitia a fost creata acum, deci folosim now*/

        if (isset($_GET['denumire_petitie'])) {
            $denumire_petitie = $_GET['denumire_petitie'];
        }
        if (isset($_GET['domeniu'])) {
            $domeniu = ucfirst($_GET['domeniu']);
        }
        if (isset($_GET['data_expirare'])){
            $data_expirare= construct_exp_date($_GET['data_expirare']);
        }
        
        if (isset($_GET['descriere'])){
            $descriere=$_GET['descriere'];
        }
        
        /*var_dump($denumire_petitie);
        var_dump($domeniu);
        var_dump($data_expirare);
        var_dump($descriere);*/
        
        
        $petition_insert = oci_parse($conn, 'INSERT INTO PETITII VALUES (null, :creator_id, :denumire_petitie, :domeniu, :descriere, :numar_semnaturi, to_date(:data_expirare, \'DD-MM-YYYY HH24:MI:SS\'), to_date(:created_at, \'DD-MM-YYYY HH24:MI:SS\'))');
        oci_bind_by_name($petition_insert, ':creator_id', $creator_id);
        oci_bind_by_name($petition_insert, ':denumire_petitie', $denumire_petitie);
        oci_bind_by_name($petition_insert, ':domeniu', $domeniu);
        oci_bind_by_name($petition_insert, ':descriere', $descriere);
        oci_bind_by_name($petition_insert, ':numar_semnaturi', $numar_semnaturi);
        oci_bind_by_name($petition_insert, ':data_expirare', $data_expirare);
        oci_bind_by_name($petition_insert, ':created_at', $created_at);
        
        oci_execute($petition_insert);

        echo "<p>Am incercat, maybe worked. Trust me.</p>";

        oci_free_statement($petition_insert);
        
        header("Location: ../Views/logged.php");
       
?>
        
