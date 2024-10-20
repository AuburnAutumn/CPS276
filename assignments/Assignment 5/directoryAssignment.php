<?php
//Sets the output default to blank
$output = "";

//Just calls the handler if the button is clicked
if(isset($_POST['createDirectoryButton'])){
  require_once 'fileHandler.php';
  $fileAdd = new fileHandler();
  $output = $fileAdd->createFile();
}

?>

<!doctype php>
<html lang="en">

    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Directory Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    </head>
    <div class="container mt-5">

    <h1>File and Directory Assignment</h1>

    <body>
        <p>Enter a folder name and the contents of a file. Folder names should include alpha numeric characters only.</p>

    <div class="mt-4">
      <?php if (!empty($output)): ?>
        <p><?php echo $output; ?></p>
      <?php endif; ?>


    <form method="POST" action="">
    <div class="mb-3">
        <label for="folderNameInput" class="form-label">Folder name</label>
        <input type="text" class="form-control" id="folderNameInput" name="folderNameInput">    
    </div>

    <div class="mb-3">
        <label for="fileContentsInput" class="form-label">File content</label>
        <textarea class="form-control" id="fileContentsInput" name="fileContentsInput" rows="3"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="createDirectoryButton" id="createDirectoryButton" value="Submit" />
    </div>
</div>
</form>
    </body>

</html>