<?php
  require_once 'classes/Pdo_methods.php'; 
  require_once 'classes/Validation.php';
  require_once('classes/StickyForm.php');
$stickyForm = new StickyForm();
$validation = new Validation();

/*THE INIT FUNCTION IS WRITTEN TO START EVERYTHING OFF IT IS CALLED FROM THE INDEX.PHP PAGE */
function init() {
  global $elementsArr, $stickyForm, $validation;

  $loginError = "";
  if (session_status() == PHP_SESSION_NONE) {
} elseif (session_status() == PHP_SESSION_ACTIVE) {
}


  if (isset($_POST['login'])) {
    //Checks to make sure email is valid, and that password isn't blank
    $postArr = $stickyForm->validateForm($_POST, $elementsArr);
    if($postArr['masterStatus']['status'] == "noerrors"){
      $loginMessage = login();
      return getForm($loginMessage, $elementsArr);
  } else {
    /* IF THERE WAS A PROBLEM WITH THE FORM VALIDATION THEN THE MODIFIED ARRAY ($postArr) WILL BE SENT AS THE SECOND PARAMETER.  THIS MODIFIED ARRAY IS THE SAME AS THE ELEMENTS ARRAY BUT ERROR MESSAGES AND VALUES HAVE BEEN ADDED TO DISPLAY ERRORS AND MAKE IT STICKY */
    return getForm("",$postArr);
  } 
  } else {
      return getForm("", $elementsArr);
  }
}



function login() {
    $pdo = new PdoMethods();
    $sql = "SELECT email, password, status, name FROM admins WHERE email = :email";

    $bindings = [
        [':email', $_POST['email'], 'str']
    ];

    $records = $pdo->selectBinded($sql, $bindings);

    if ($records == 'error') {
        return "Database query error.";
    } elseif (count($records) == 0) {
        //If it can't find any emails or anything
        //Could return "email not in use" but that seems like it would give too much information
        //to people blindly guessing
        return "Login credentials incorrect";
    } else {
      //Varify hashed password
        if (password_verify($_POST['password'], $records[0]['password'])) {
          //Starts session, sets up access and name
          session_start();
            $_SESSION['access'] = ($records[0]['status'] === 'admin') ? "adminAccess" : "staffAccess";
            $_SESSION['username'] = $records[0]['name'];
            header("Location: index.php?page=welcome");
            exit;
        } else {
            //If password is wrong
            return "Login credentials incorrect";
        }
    }
}


/* THIS IS THE DATA OF THE FORM.  IT IS A MULTI-DIMENTIONAL ASSOCIATIVE ARRAY THAT IS USED TO CONTAIN FORM DATA AND ERROR MESSAGES.   EACH SUB ARRAY IS NAMED BASED UPON WHAT FORM FIELD IT IS ATTACHED TO. FOR EXAMPLE, "NAME" GOES TO THE TEXT FIELDS WITH THE NAME ATTRIBUTE THAT HAS THE VALUE OF "NAME". NOTICE THE TYPE IS "TEXT" FOR TEXT FIELD.  DEPENDING ON WHAT HAPPENS THIS ASSOCIATE ARRAY IS UPDATED.*/
$elementsArr = [
  "masterStatus"=>[
    "status"=>"noerrors",
    "type"=>"masterStatus"
  ],
	"email"=>[
	  "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Email cannot be blank and must be written as a proper email</span>",
    "errorOutput"=>"",
    "type"=>"text",
    "value"=>"abonk@admin.com",
		"regex"=>"email"
	],
	"password"=>[
		"errorMessage"=>"<span style='color: red; margin-left: 15px;'>Password cannot be blank</span>",
    "errorOutput"=>"",
    "type"=>"text",
		"regex"=>"pass",
    "value"=>"password"
  ]
];

/*THIS IS THE GETFORM FUCTION WHICH WILL BUILD THE FORM AND CONTENT BASED UPON UPON THE (UNMODIFIED OF MODIFIED) ELEMENTS ARRAY. */
function getForm($acknowledgement, $elementsArr){
global $stickyForm;
$errorMessage = "";

//Displays error in the right place and changes acknowledgement so it's not displayed above the heading
if ($acknowledgement != null || $acknowledgement == ""){
  $errorMessage = $acknowledgement;
  $acknowledgement = "";
}

//<link href="public/css/main.css" rel="stylesheet">
/* THIS IS A HEREDOC STRING WHICH CREATES THE FORM AND ADDS THE APPROPRIATE VALUES AND ERROR MESSAGES */
$form = <<<HTML
    <form method="post" action="index.php?page=login">
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Login</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
      </head>
  <body>
    <div class="container">
      <h1>Login</h1>
      <p>{$errorMessage}</p>
      <form action="index.php" method="post">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="email">Email{$elementsArr['email']['errorOutput']}</label>
            <input type="text" class="form-control" name="email" id="email" value="{$elementsArr['email']['value']}">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="password">Password{$elementsArr['password']['errorOutput']}</label>
            <input type="password" class="form-control" id="password" name="password" value="{$elementsArr['password']['value']}">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <input type="submit" class="btn btn-primary" name="login" value="Login">
          </div>
        </div>
      </div>
      </form>

    </div>
  </body>

HTML;

/* HERE I RETURN AN ARRAY THAT CONTAINS AN ACKNOWLEDGEMENT AND THE FORM.  THIS IS DISPLAYED ON THE INDEX PAGE. */
return [$acknowledgement, $form];

}

?>