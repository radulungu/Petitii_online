<?php
    require "check_auth.php";
    
    if ($_SESSION["Auth_is_admin"] == 1) {
        
        $filename = "../Public/cache/" . $_SESSION["Auth_id"] . "/htmlExport.html";
        
        if(!file_exists($filename)) {
            
            include('HelperClasses/connection.php');
            $conn = OracleConnection::getConnection();
            require "adminRaports.php";
            require "HelperClasses/DOM_Helper.php";
            
            $htmlExport = new DOMDocument('1.0');
            $htmlExport->formatOutput = true;
            
            $header = myCreateChild($htmlExport, $htmlExport, "header");
            
            $body = myCreateChild($htmlExport, $htmlExport, "body");

            foreach($results_reports as $result) {
                
                if (strtotime(date('d-M-y', strtotime($result['EXPIRARE']))) > strtotime(date('d-M-y', strtotime("now")))) {
                   
                    $valid = "DA";
            
                } else { 
                
                    $valid = "NU";
                    
                }
                
                $table = myCreateChild($htmlExport, $body, "table");
                
                $row = myCreateChild($htmlExport, $table, "tr");
                
                myCreateEntry($htmlExport, $row, "td", "PETITIE ID: ");
                myCreateEntry($htmlExport, $row, "td", $result["ID"]);
                
                $row = myCreateChild($htmlExport, $table, "tr");
                
                myCreateEntry($htmlExport, $row, "td", "CREATOR ID: ");
                myCreateEntry($htmlExport, $row, "td", $result["CREATOR_ID"]);
                
                $row = myCreateChild($htmlExport, $table, "tr");
                
                myCreateEntry($htmlExport, $row, "td", "NAME: ");
                myCreateEntry($htmlExport, $row, "td", $result["NAME"]);
                
                $row = myCreateChild($htmlExport, $table, "tr");
                
                myCreateEntry($htmlExport, $row, "td", "DOMENIU: ");
                myCreateEntry($htmlExport, $row, "td", $result["DOMENIU"]);
                
                $row = myCreateChild($htmlExport, $table, "tr");
                
                myCreateEntry($htmlExport, $row, "td", "DESCRIERE: ");
                myCreateEntry($htmlExport, $row, "td", $result["DESCRIERE"]);
                
                $row = myCreateChild($htmlExport, $table, "tr");
                
                myCreateEntry($htmlExport, $row, "td", "NUMAR SEMNATURI: ");
                myCreateEntry($htmlExport, $row, "td", $result["NUMAR_SEMNATURI"]);
                
                $row = myCreateChild($htmlExport, $table, "tr");
                
                myCreateEntry($htmlExport, $row, "td", "VALID: ");
                myCreateEntry($htmlExport, $row, "td", $valid);
                
                $row = myCreateChild($htmlExport, $table, "tr");
                
                myCreateEntry($htmlExport, $row, "td", "EXPIRARE: ");
                myCreateEntry($htmlExport, $row, "td", $result["EXPIRARE"]);
                
                $row = myCreateChild($htmlExport, $table, "tr");
                
                myCreateEntry($htmlExport, $row, "td", "CREATED AT: ");
                myCreateEntry($htmlExport, $row, "td", $result["CREATED_AT"]);
                
                myCreateChild($htmlExport, $body, "br");
                myCreateChild($htmlExport, $body, "br");
                myCreateChild($htmlExport, $body, "br");

            }

            file_put_contents($filename, $htmlExport->saveHTML());
            
        }
        
        header('Content-Disposition: attachment; filename="' . "htmlExport.html" . '"');
        readfile($filename);
        
    }
?>