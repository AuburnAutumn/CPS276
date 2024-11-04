<?php
//Sets the output default to blank
$output = "";

//Just calls the handler if the button is clicked
if(isset($_POST['uploadFileButton'])){
  require_once 'fileUploadProc.php';
  $fileAdd = new fileUploader();
  $output = $fileAdd->addFile();
}

?>

<!doctype php>
<html lang="en">

    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Table Upload Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>

    <body>
    <div class="container mt-5">

    <h1>File Upload</h1>

    <a href="listDisplay.php">Show file list</a>


        
    <div class="mt-4">
      <?php if (!empty($output)): ?>
        <p><?php echo $output; ?></p>
      <?php endif; ?>


    <form method="POST" action="" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="fileNameInput" class="form-label">File name</label>
        <input type="text" class="form-control" id="fileNameInput" name="fileNameInput">    
    </div>

    <div class="mb-3">
        <label for="formFile" class="form-label"></label>
        <input class="form-control" type="file" id="formFile" name="fileNameInput">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="uploadFileButton" id="uploadFileButton" value="Upload File" />
    </div>
</div>
</form>
    </body>

</html>