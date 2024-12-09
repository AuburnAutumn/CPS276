<?php
/* HERE I REQUIRE AND USE THE STICKYFORM CLASS THAT DOES ALL THE VALIDATION AND CREATES THE STICKY FORM.  THE STICKY FORM CLASS USES THE VALIDATION CLASS TO DO THE VALIDATION WORK.*/
require_once('classes/StickyForm.php');
$stickyForm = new StickyForm();
$message = "";

/*THE INIT FUNCTION IS WRITTEN TO START EVERYTHING OFF IT IS CALLED FROM THE INDEX.PHP PAGE */
function init(){
  global $elementsArr, $stickyForm;

  /* IF THE FORM WAS SUBMITTED DO THE FOLLOWING  */
  if(isset($_POST['submit'])){

    /*THIS METHODS TAKE THE POST ARRAY AND THE ELEMENTS ARRAY (SEE BELOW) AND PASSES THEM TO THE VALIDATION FORM METHOD OF THE STICKY FORM CLASS.  IT UPDATES THE ELEMENTS ARRAY AND RETURNS IT, THIS IS STORED IN THE $postArr VARIABLE */
    $postArr = $stickyForm->validateForm($_POST, $elementsArr);

    /* THE ELEMENTS ARRAY HAS A MASTER STATUS AREA. IF THERE ARE ANY ERRORS FOUND THE STATUS IS CHANGED TO "ERRORS" FROM THE DEFAULT OF "NOERRORS".  DEPENDING ON WHAT IS RETURNED DEPENDS ON WHAT HAPPENS NEXT.  IN THIS CASE THE RETURN MESSAGE HAS "NO ERRORS" SO WE HAVE NO PROBLEMS WITH OUR VALIDATION AND WE CAN SUBMIT THE FORM */
    if($postArr['masterStatus']['status'] == "noerrors"){
      
      /*addData() IS THE METHOD TO CALL TO ADD THE FORM INFORMATION TO THE DATABASE THEN WE CALL THE GETFORM METHOD WHICH RETURNS AND ACKNOWLEDGEMENT AND THE ORGINAL ARRAY (NOT MODIFIED). THE ACKNOWLEDGEMENT IS THE FIRST PARAMETER THE ELEMENTS ARRAY IS THE ELEMENTS ARRAY WE CREATE (AGAIN SEE BELOW) */
      return addData($_POST);

    }
    else{
      /* IF THERE WAS A PROBLEM WITH THE FORM VALIDATION THEN THE MODIFIED ARRAY ($postArr) WILL BE SENT AS THE SECOND PARAMETER.  THIS MODIFIED ARRAY IS THE SAME AS THE ELEMENTS ARRAY BUT ERROR MESSAGES AND VALUES HAVE BEEN ADDED TO DISPLAY ERRORS AND MAKE IT STICKY */
      return getForm("",$postArr,"");
    }
    
  }

  /* THIS CREATES THE FORM BASED ON THE ORIGINAL ARRAY THIS IS CALLED WHEN THE PAGE FIRST LOADS BEFORE A FORM HAS BEEN SUBMITTED */
  else {
      return getForm("", $elementsArr, "");
    } 
}

/* THIS IS THE DATA OF THE FORM.  IT IS A MULTI-DIMENTIONAL ASSOCIATIVE ARRAY THAT IS USED TO CONTAIN FORM DATA AND ERROR MESSAGES.   EACH SUB ARRAY IS NAMED BASED UPON WHAT FORM FIELD IT IS ATTACHED TO. FOR EXAMPLE, "NAME" GOES TO THE TEXT FIELDS WITH THE NAME ATTRIBUTE THAT HAS THE VALUE OF "NAME". NOTICE THE TYPE IS "TEXT" FOR TEXT FIELD.  DEPENDING ON WHAT HAPPENS THIS ASSOCIATE ARRAY IS UPDATED.*/
$elementsArr = [
  "masterStatus"=>[
    "status"=>"noerrors",
    "type"=>"masterStatus"
  ],
	"name"=>[
	  "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Name cannot be blank and must be a standard name</span>",
    "errorOutput"=>"",
    "type"=>"text",
    "value"=>"Angela Bonk",
		"regex"=>"name"
	],

  "email"=>[
		"errorMessage"=>"<span style='color: red; margin-left: 15px;'>Email cannot be blank and must be a valid email address</span>",
    "errorOutput"=>"",
    "type"=>"text",
		"value"=>"abonk@admin.com",
    "regex"=>"email"
  ],

  "password"=>[
	  "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Password cannot be blank</span>",
    "errorOutput"=>"",
    "type"=>"text",
    "value"=>"password",
    "regex"=>"pass"
	],

  "status"=>[
    "type"=>"select",
    "options"=>["staff"=>"Staff","admin"=>"Admin"],
		"selected"=>"staff",
		"regex"=>"name"
	]

	
];

/*THIS FUNCTION CAN BE CALLED TO ADD DATA TO THE DATABASE */
function addData($post){
  global $elementsArr;  
  /* IF EVERYTHING WORKS ADD THE DATA HERE TO THE DATABASE HERE USING THE $_POST SUPER GLOBAL ARRAY */
      //print_r($_POST);
      require_once('classes/Pdo_methods.php');

      $pdo = new PdoMethods();

  // Check if the email already exists
      $sqlCheck = "SELECT COUNT(*) AS count FROM admins WHERE email = :email";
    $bindingsCheck = [
        [':email', $post['email'], 'str'],
      ];

    $resultCheck = $pdo->selectBinded($sqlCheck, $bindingsCheck);

    if ($resultCheck == "error" || $resultCheck[0]['count'] > 0) {
     $message = $resultCheck == "error" 
          ? "<p>There was a problem checking the email</p>"
          : "<p>That email already exists</p>";
     return getForm("", $elementsArr,$message);
    }

      $sql = "INSERT INTO admins (name, email, password, status) VALUES (:name, :email, :password, :status)";

      //Hashing password before sending it to data base
      $password = $_POST['password'];
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      $bindings = [
        [':name',$post['name'],'str'],
        [':email',$post['email'],'str'],
        [':password',$hashedPassword,'str'],
        [':status', $post['status'], 'str'],
      ];

      $result = $pdo->otherBinded($sql, $bindings);

      if($result == "error"){
        $message = "There was a problem processing your form";
        return getForm("", $elementsArr, $message);
      }
      else {
        $message = "Admin has been added";
        return getForm("", $elementsArr, $message);
      }
      
}
   

/*THIS IS THE GETFORM FUCTION WHICH WILL BUILD THE FORM AND CONTENT BASED UPON UPON THE (UNMODIFIED OF MODIFIED) ELEMENTS ARRAY. */
//getForm changed to take in a third parameter so I can display the messages below the title instead of above it with Index
function getForm($acknowledgement, $elementsArr, $message){

global $stickyForm;
$options = $stickyForm->createOptions($elementsArr['status']);

/* THIS IS A HEREDOC STRING WHICH CREATES THE FORM AND ADDS THE APPROPRIATE VALUES AND ERROR MESSAGES */
$form = <<<HTML
    <form method="post" action="index.php?page=addAdmin">
    <h1>Add Admin</h1>
    <p>{$message}</p>
    <div class="form-group">
      <label for="name">Name (letters only){$elementsArr['name']['errorOutput']}</label>
      <input type="text" class="form-control" id="name" name="name" value="{$elementsArr['name']['value']}" >
    </div>

    <div class="form-group">
      <label for="email">Email {$elementsArr['email']['errorOutput']}</label>
      <input type="text" class="form-control" id="email" name="email" value="{$elementsArr['email']['value']}" >
    </div>

    <div class="form-group">
      <label for="password">Password{$elementsArr['password']['errorOutput']}</label>
      <input type="password" class="form-control" id="password" name="password" value="{$elementsArr['password']['value']}">
    </div>

    <div class="form-group">
      <label for="status">Status</label>
      <select class="form-control" id="status" name="status">
        $options
      </select>
    </div>
    
    <div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </div>
  
  </form>

HTML;

/* HERE I RETURN AN ARRAY THAT CONTAINS AN ACKNOWLEDGEMENT AND THE FORM.  THIS IS DISPLAYED ON THE INDEX PAGE. */
return [$acknowledgement, $form];

}

?>