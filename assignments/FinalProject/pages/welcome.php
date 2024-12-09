<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
/* HERE I REQUIRE AND USE THE STICKYFORM CLASS THAT DOES ALL THE VALIDATION AND CREATES THE STICKY FORM.  THE STICKY FORM CLASS USES THE VALIDATION CLASS TO DO THE VALIDATION WORK.*/
require_once('classes/StickyForm.php');
$stickyForm = new StickyForm();

/*THE INIT FUNCTION IS WRITTEN TO START EVERYTHING OFF IT IS CALLED FROM THE INDEX.PHP PAGE */
function init(){
  global $elementsArr, $stickyForm;
    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
        // Redirect to the login page if not logged in
        header("Location: index.php?page=login");
        exit;
    }
    return getForm("", $elementsArr);
} 


/* THIS IS THE DATA OF THE FORM.  IT IS A MULTI-DIMENTIONAL ASSOCIATIVE ARRAY THAT IS USED TO CONTAIN FORM DATA AND ERROR MESSAGES.   EACH SUB ARRAY IS NAMED BASED UPON WHAT FORM FIELD IT IS ATTACHED TO. FOR EXAMPLE, "NAME" GOES TO THE TEXT FIELDS WITH THE NAME ATTRIBUTE THAT HAS THE VALUE OF "NAME". NOTICE THE TYPE IS "TEXT" FOR TEXT FIELD.  DEPENDING ON WHAT HAPPENS THIS ASSOCIATE ARRAY IS UPDATED.*/
$elementsArr = [
  "masterStatus"=>[
    "status"=>"noerrors",
    "type"=>"masterStatus"
  ],
];
   

/*THIS IS THE GETFORM FUCTION WHICH WILL BUILD THE FORM AND CONTENT BASED UPON UPON THE (UNMODIFIED OF MODIFIED) ELEMENTS ARRAY. */
function getForm($acknowledgement, $elementsArr){
  //Grabs user's name from SESSION
$username = $_SESSION['username'];
$greeting = "Welcome, $username";
global $stickyForm;

/* THIS IS A HEREDOC STRING WHICH CREATES THE FORM AND ADDS THE APPROPRIATE VALUES AND ERROR MESSAGES */
$form = <<<HTML
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
      <h1>Welcome</h1>
      <p>{$greeting}</p>
  </body>

HTML;

/* HERE I RETURN AN ARRAY THAT CONTAINS AN ACKNOWLEDGEMENT AND THE FORM.  THIS IS DISPLAYED ON THE INDEX PAGE. */
return [$acknowledgement, $form];

}

?>