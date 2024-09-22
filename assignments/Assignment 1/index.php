<!doctype php>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class = "container">
        
    <form class="row g-3" method="post" action="#">
  <div class="col-md-6">
    <label for="firstName" class="form-label">First Name</label>
    <input type="text" class="form-control" id="firstName">
  </div>
  <div class="col-md-6">
    <label for="lastName" class="form-label">Last Name</label>
    <input type="text" class="form-control" id="lastName">
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label">Address</label>
    <input type="text" class="form-control" id="inputAddress">
  </div>
  <div class="col-md-6">
    <label for="inputCity" class="form-label">City</label>
    <input type="text" class="form-control" id="inputCity">
  </div>
  <div class="col-md-4">
    <label for="inputState" class="form-label">State</label>
    <select id="inputState" class="form-select">
      <option value="Ohio">Ohio</option>
      <option value="Indiana">Indiana</option>
      <option selected value="Michigan">Michigan</option>
      <option value="Mississippi">Mississippi</option>
      <option value="Illinois">Illinois</option>
    </select>
  </div>
  <div class="col-md-2">
    <label for="inputZip" class="form-label">Zip</label>
    <input type="text" class="form-control" id="inputZip">
  </div>

  <div class="col-md-2">
  <input class="form-check-input" type="radio" name="radio" id="maleRadio">
  <label class="form-check-label" for="maleRadio">
    Male
  </label>
</div>
<div class="col-md-2">
  <input class="form-check-input" type="radio" name="radio" id="femaleRadio">
  <label class="form-check-label" for="femaleRadio">
    Female
  </label>
</div>

  <div class="col-12">
    <button type="submit" class="btn btn-primary">Register</button>
  </div>
</form>

    </div>
    </body>
</html>

