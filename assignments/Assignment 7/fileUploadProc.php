<?php
require 'Pdo_methods.php';

class fileUploader extends PdoMethods{

public function addFile(){
	
    $maxFileSize = 100000;

    if (isset($_FILES['fileNameInput']) && $_FILES['fileNameInput']['error'] === UPLOAD_ERR_OK) {
        $fileType = mime_content_type($_FILES['fileNameInput']['tmp_name']);
        $fileSize = $_FILES['fileNameInput']['size'];
    
    // Check if file is a PDF and below the specified size limit
    if ($fileType === 'application/pdf' && $fileSize <= $maxFileSize) {

    $pdo = new PdoMethods();

    $targetDir = 'pdfsDirectory';

    if (!is_dir($targetDir) || !is_writable($targetDir)) {
        return "Error: Target directory does not exist or is not writable.";
    }

    $sql = "INSERT INTO assignmentSevenTable (fileName, filePath) VALUES (:fileName, :filePath)";

     $filePath = $targetDir ."/" . baseName($_FILES['fileNameInput']['name']);


    if (move_uploaded_file($_FILES['fileNameInput']['tmp_name'], $filePath)) {
    } else {
        Return "Error: There was a problem uploading your file.";
    }
        
    $bindings = [
        [':fileName',$_POST['fileNameInput'],'str'],
        [':filePath',$filePath,'str'],
    ];

    $result = $pdo->otherBinded($sql, $bindings);

    if ($result === 'error') {
        return 'There was an error adding the file';
    } else {
        return 'File has been added';
    }
} else {
    if ($fileType === 'application/pdf') {
        return "File too big";
    } else {
        return "File must be a pdf file";
    }
    }
    }
    }
}