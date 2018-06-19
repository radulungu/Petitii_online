<?php

header("Content-Type: text/plain");
require "HelperClasses/DOM_Helper.php";

#init atom
$atom = new DOMDocument('1.0', 'utf-8');
$atom->formatOutput = true;

#creare feed
$feed = myCreateChild($atom, $atom, "feed");

#creare header
myCreateEntry($atom, $feed, "title", "Latest Petitions");
    
myCreateEntry($atom, $feed, "updated", "2017-06-17T13:40:02Z");
    
myCreateEntry($atom, $feed, "id", "Petitii");

#luam cele mai noi petitii din BD
$results = getLatestPetitions();

#populam atom-ul cu rezultatele din BD
makeAtom($atom, $feed, $results);

#afisam atom-ul
echo $atom->saveXML();



function makeAtom($atom, $feed, $results) {
    
    foreach($results as $result) {
        
        $name = $result["NAME"];
        $link = "http://localhost:8181/Petitii/Views/lista_petitii.php" . "?denumire_petitie=" . $result["NAME"] . "&domeniu=&interval=";
        $id = $result["DOMENIU"];
        $created_at = $result["CREATED_AT"];
        $descriere = $result["DESCRIERE"];

        $entry = myCreateChild($atom, $feed, "entry");
        
        $title = myCreateEntry($atom, $entry, "title", $created_at . " " . $name);
        $link = myCreateEntry($atom ,$entry, "link", "", array("href" => $link));
        $id = myCreateEntry($atom, $entry, "id", $id);
        $updated = myCreateEntry($atom, $entry, "updated", $created_at);
        $summary = myCreateEntry($atom, $entry, "summary", $descriere);

    }
    
}

function getLatestPetitions() {
    
    include('HelperClasses/connection.php');
    $conn = OracleConnection::getConnection();
    
    $latest_petitii = oci_parse($conn, 'SELECT * FROM PETITII WHERE rownum < 10 ORDER BY created_at DESC');
    oci_execute($latest_petitii);
    
    $results = array();
        
    while($row = oci_fetch_array($latest_petitii, OCI_BOTH)) {
        
        #var_dump($row);
        array_push($results, $row);
        
    }
    
    return $results;
    
}

?>