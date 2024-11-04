<?php
require_once 'listFilesProc.php';
  $listWriter = new listWriter();
  $output = $listWriter->writeList();

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

    <h1>List Files</h1>

    <a href="fileUpload.php">Add file</a>
    <div class="mt-4">
      <?php if (!empty($output)): ?>
        <p><?php echo $output; ?></p>
      <?php endif; ?>

    </body>

</html>