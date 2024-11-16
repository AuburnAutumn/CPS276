<?php

/*Output is initilized as an int because the table checks for String and the error checks for an empty array,
so starting it as an int prevents anything from showing up when the page first loads*/
$output = 1;

if(isset($_POST['getNotesButton'])){
    require_once 'noteHandler.php';
    $noteHandler = new noteUploader();
    $output = $noteHandler->displayNotes();
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

    <h1>Display Notes</h1>

    <body>
    <a href="addNote.php">Add Notes</a>

    <form method="POST" action="">
    <div class="mb-3">
        <label for ="begDate" class = "form-label">Beginning date</label>
        <input type="date" class="form-control" id="begDate" name="begDate">
    </div>

    <div class="mb-3">
        <label for ="endDate" class = "form-label">End date</label>
        <input type="date" class="form-control" id="endDate" name="endDate">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="getNotesButton" id="getNotesButton" value="Get notes" />

    </div>


    <div>
    <?php if (is_string($output)) : ?>
    <table class="table table-striped-columns">
        <thead>
        <tr>
            <th scope="col">Date and Time</th>
            <th scope="col">Note</th>
         </tr>
         <tbody>
            <?php echo $output; ?>
        </tbody>
    </table>
    <?php elseif (empty($output)) : ?>
        <?php echo "No notes found for the date range selected"; ?>

    <?php elseif (is_int($output)) : ?>

    <?php endif; ?>
</div>

</form>
    </body>

</html>