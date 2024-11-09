<?php
require_once '../classes/Pdo_methods.php';
$pdo = new PdoMethods();
$sql = "SELECT * FROM names";
$records = $pdo->selectNotBinded($sql);
if($records == 'error'){
    return 'There has been and error processing your request';
}else {
    if (count($records) != 0) {
        $links = [];
        
        //Grabs names from data table and seperates each into a paragraph element, then adds them to array
        foreach ($records as $record) {
            $newName = '<p>' . (htmlspecialchars($record['name'])) . '</p>';
            $names[] = $newName;
        }

        $response['masterstatus'] = 'success';
        //Implodes array into a string
        //Nothing passed in to seperate each name as they are all already paragraphs
        $response['names'] = implode("", $names); 
    } 

    echo json_encode($response);
    }


?>