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
                    // Replace 'yourLinkPrefix' with the actual URL or link structure you want to use
                    $link = '<a href="' . $record['filePath'] . '">' . htmlspecialchars($record['fileName']) . '</a>';
                    $links[] = $link;
                }
                
                // Join all links into a single string
                $linkString = implode("\n", $links); 
                
                return $linkString;
			}
			else {
				return 'no names found';
			}

        return "writeList being called";

    }
}
}