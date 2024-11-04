<?php
require 'Pdo_methods.php';

class listWriter {

    public function writeList(){

        $pdo = new PdoMethods();
        $sql = "SELECT * FROM assignmentSevenTable";
        $records = $pdo->selectNotBinded($sql);
        if($records == 'error'){
			return 'There has been and error processing your request';
		}else {
			if (count($records) != 0) {
                $links = [];
                
                foreach ($records as $record) {
                    $link = '<li>' . '<a target=\'_blank\' href="' . $record['filePath'] . '">' . htmlspecialchars($record['fileName']) . '</a>' . '</li>';
                    $links[] = $link;
                }
                
                //Builds string
                $linkString = implode("", $links); 
                
                return "<ul>" . $linkString . "</ul>";
			}
			else {
				return 'No files found';
			}
        }
    }
}