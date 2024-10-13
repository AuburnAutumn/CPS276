<?php

if(count($_POST) > 0){
    require_once 'addNameProc.php';
    $addName = new AddNamesProc();
    $output = $addName->addClearNames();
   }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Add Names</title>
    <style>
      input[type="radio"]{margin: 0 10px 0 0;}
    </style>
  </head>
  <body>
    <main class="container">
      <h1>Add Names</h1>
      <form action="nameSort.php" method="post">
      <div class="form-group">
        <input type="submit" class="btn btn-primary" name="addNameButton" id="addNameButton" value="Add Name" />
        <input type="submit" class="btn btn-primary" name="clearNamesButton" id="clearNamesButton" value="Clear Names" />
      </div>
      <div class="col-md-6">
        <label for="newName" class="form-label">Enter Name</label>
        <input type="text" class="form-control" id="newName" name = "newName">
      </div>

      <input type="hidden" name="namesListHidden" value="<?php echo isset($output) ? htmlspecialchars($output) : ''; ?>">
      </form>
      <div>
      <br>
      <div class="form-group">
        <label for="namesList">List of names:</label>
        <textarea id="namesList" name="namesList" rows="15" class="form-control"><?php echo isset($output) ? htmlspecialchars($output) : ''; ?></textarea>
      </div>
    </main>
  </body>
</html>