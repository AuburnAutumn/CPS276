<?php

$path = "index.php?page=login";

session_start();

//Prevents people who have not logged in from typing in the URL to access pages
if ((!isset($_SESSION['access']) || empty($_SESSION['access'])) && 
    (!isset($_GET['page']) || $_GET['page'] !== 'login')) {
    header('Location: ' . $path);
    exit(); 
}

$status = isset($_SESSION['access']) ? $_SESSION['access'] : null;

//Makes sure there is an actual session in progress
if ($status == null || $status == ""){
    $nav = "";
} else {
    //Checks for adminAccess to display the right nav
    if ($status == "adminAccess"){
        $nav=<<<HTML
        <nav>
            <a href="index.php?page=addContact">Add Contact</a>
            <a href="index.php?page=deleteContacts">Delete Contact(s)</a>
            <a href="index.php?page=addAdmin">Add Admin</a>
            <a href="index.php?page=deleteAdmins">Delete Admin(s)</a>
            <a href="logout.php">Logout</a></p>
        </nav>

        <style>
        nav a {
            margin-right: 20px; 
        }
        </style>
    HTML;
        //<style> inserts small gaps between all the links

        //If there is a session and it isn't an adminAccess session, it assumes the session to be staff
        //Seemed safer than defaulting to admin
    } else {
        $nav=<<<HTML
        <nav>
            <a href="index.php?page=addContact">Add Contact</a>
            <a href="index.php?page=deleteContacts">Delete Contact(s)</a>
            <a href="logout.php">Logout</a></p>
        </nav>

        <style>
        nav a {
            margin-right: 20px; 
        }
        </style>

    HTML;
    }
}


if(isset($_GET)){
    if($_GET['page'] === "addContact"){
        require_once('pages/addContact.php');
        $result = init();
    }
    
    else if($_GET['page'] === "deleteContacts"){
        require_once('pages/deleteContacts.php');
        $result = init();
    }

    else if($_GET['page'] === "login"){
        require_once('pages/login.php');
        $result = init();
    }

    else if($_GET['page'] === "welcome"){
        require_once('pages/welcome.php');
        $result = init();
    }

    else if($_GET['page'] === "addAdmin"){
        if($status == "adminAccess"){
        require_once('pages/addAdmin.php');
        $result = init();} else {
            header('Location: index.php?page=welcome');
            exit();
        }
    }

    else if($_GET['page'] === "deleteAdmins"){
        if($status == "adminAccess"){
        require_once('pages/deleteAdmins.php');
        $result = init();
    } else {
        header('Location: index.php?page=welcome');
        exit();
    }
    }

    else {
        header('location: '.$path);
    }
}

else {
    header('location: '.$path);
}



?>


