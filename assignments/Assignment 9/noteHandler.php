<?php
require 'Pdo_methods.php';

class noteUploader extends PdoMethods{

    public function addNote(){
     
        if (!empty($_POST['dateTime']) && !empty($_POST['noteContentsInput'])) {
            $datetime = $_POST['dateTime']; 
            //Converts to timestamp
            $timestamp = strtotime($datetime); 
        
            
            if ($timestamp !== false) {
                //echo "Timestamp: " . $timestamp;

                $pdo = new PdoMethods();
                $sql = "INSERT INTO notesList (dateCreated, note) VALUES (:dateCreated, :note)";

                $bindings = [
                    [':note',$_POST['noteContentsInput'],'str'],
                    [':dateCreated',$timestamp,'int'],
                ];

            $result = $pdo->otherBinded($sql, $bindings);

            if ($result === 'error') {
                return 'There was an error adding the note';
            } else {
                return 'Note has been added';
            }

            } else {
                return "Invalid datetime format.";
            }
        } else {
            return "A date and note must be provided.";
        }


    }

    public function displayNotes(){

        //Converts begining and end date to integers to compared to stored dateCreated, an int
        $begDate = strtotime($_POST['begDate']);
        $endDate = strtotime($_POST['endDate']);

        $sql = "SELECT dateCreated, note FROM notesList WHERE dateCreated BETWEEN :begDate AND :endDate ORDER BY dateCreated DESC";

        $bindings = [
            [':begDate', $begDate, 'int'],
            [':endDate', $endDate, 'int'],
        ];
    
        $pdo = new PdoMethods();
        $records = $pdo->selectBinded($sql, $bindings);

        if ($records === 'error') {
            return '<tr><td colspan="2">There was an error retrieving the notes.</td></tr>';
        }
       
        if ($records === 'error') {
            return '<tr><td colspan="2">There was an error retrieving the notes.</td></tr>';
        } else if (count($records) === 0) {
            //Returns blank to tell the table to not display
            return;
        }

        $rows = '';
        foreach ($records as $row) {
            $timestamp = $row['dateCreated'];
            $formattedDate = date('Y-m-d H:i:s', $row['dateCreated']);
            $rows .= "<tr><td>{$formattedDate}</td><td>{$row['note']}</td></tr>";
        }
        //Returns String which tells the table to display
        return $rows;
    }
}

