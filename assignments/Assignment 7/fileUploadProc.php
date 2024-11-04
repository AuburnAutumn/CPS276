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

    $targetDir = 'pdfsDirectory/';
    if (!is_dir($targetDir) || !is_writable($targetDir)) {
        return "Error: Target directory does not exist or is not writable.";
    }

    /* HERE I CREATE THE SQL STATEMENT I AM BINDING THE PARAMETERS */
    $sql = "INSERT INTO assignmentSevenTable (fileName, filePath) VALUES (:fileName, :filePath)";

    $filePath = '~abonk/assignments/Assignment%207/pdfsDirectory/' . basename($_FILES['fileNameInput']['name']);

    if (move_uploaded_file($_FILES['fileNameInput']['tmp_name'], $filePath)) {
        echo "The file " . htmlspecialchars($_FILES['fileNameInput']['name']) . " has been uploaded successfully.";
    } else {
        echo "Error: There was a problem uploading your file.";
    }
        

    /* THESE BINDINGS ARE LATER INJECTED INTO THE SQL STATEMENT THIS PREVENTS AGAIN SQL INJECTIONS */
    $bindings = [
        [':fileName',$_POST['fileNameInput'],'str'],
        [':filePath',$filePath,'str'],
    ];

    /* I AM CALLING THE OTHERBINDED METHOD FROM MY PDO CLASS */
    $result = $pdo->otherBinded($sql, $bindings);

    /* HERE I AM RETURNING EITHER AN ERROR STRING OR A SUCCESS STRING */
    if ($result === 'error') {
        return 'There was an error adding the file';
    } else {
        return 'File has been added';
    }
} else {
    if ($fileType === 'application/pdf') {
        return "File too large";
    } else {
        return "Please upload a pdf";
    }
    }
    }
    }
}