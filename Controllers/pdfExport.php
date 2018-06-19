<?php
    require "check_auth.php";
    
    if ($_SESSION["Auth_is_admin"] == 1) {
        
        $filename = "../Public/cache/" . $_SESSION["Auth_id"] . "/pdfExport.pdf";
        
        if(!file_exists($filename)) {
            
            include('HelperClasses/connection.php');
            $conn = OracleConnection::getConnection();
            require "adminRaports.php";
            require "../Public/fpdf/fpdf.php";
            
            $pdf = new FPDF();
            $pdf->Addpage();
            $pdf->SetFont("Arial", "", "8");
            
            foreach($results_reports as $result) {
                
                if (strtotime(date('d-M-y', strtotime($result['EXPIRARE']))) > strtotime(date('d-M-y', strtotime("now")))) {
                   
                    $valid = "DA";
            
                } else { 
                
                    $valid = "NU";
                    
                }
                
                $pdf->Cell(0,8,"PETITIE ID: " . $result["ID"], 0, 1);
                $pdf->Cell(0,8,"CREATOR ID: " . $result["CREATOR_ID"], 0, 1);
                $pdf->Cell(0,8,"NAME: " . $result["NAME"], 0, 1);
                $pdf->Cell(0,8,"DOMENIU: " . $result["DOMENIU"], 0, 1);
                $pdf->MultiCell(0,8,"DESCRIERE: " . $result["DESCRIERE"], 0);
                $pdf->Cell(0,8,"NUMAR_SEMNATURI: " . $result["NUMAR_SEMNATURI"], 0, 1);
                $pdf->Cell(0,8,"VALID: " . $valid, 0, 1);
                $pdf->Cell(0,8,"EXPIRARE: " . $result["EXPIRARE"], 0, 1);
                $pdf->Cell(0,8,"CREATED AT: " . $result["CREATED_AT"], 0, 1);
                $pdf->MultiCell(0, 8,"
                "); #adding blank line
                
            }
            
            $pdf->Output("F", $filename);
            
        }
        
        header('Content-Disposition: attachment; filename="' . "pdfExport.pdf" . '"');
        readfile($filename);
        
    }
?>