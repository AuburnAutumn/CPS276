<?php

$output = "";

if(isset($_POST['addNoteButton'])){
    require_once 'noteHandler.php';
    $noteHandler = new noteUploader();
    $output = $noteHandler->addNote();
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

    <h1>Add Notes</h1>

    <body>
    <a href="viewNote.php">Display notes</a>

    <div class="mt-4">
      <?php if (!empty($output)): ?>
        <p><?php echo $output; ?></p>
      <?php endif; ?>

    <form method="POST" action="">

    <div class="mb-3">
        <label for ="dateTime" class = "form-label">Date and Time</label>
        <input type="datetime-local" class="form-control" id="dataTime" name="dateTime">
    </div>

    <div class="mb-3">
        <label for="noteContentsInput" class="form-label">Note</label>
        <textarea class="form-control" id="noteContentsInput" name="noteContentsInput" rows="3"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="addNoteButton" id="addNoteButton" value="Add note" />
    </div>
</div>

</form>
    </body>

</html>