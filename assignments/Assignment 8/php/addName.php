<?php

$data = json_decode($_POST['data']);

if (isset($data->name)) {
    $name = $data->name;

    require_once '../classes/Pdo_methods.php';
    $pdo = new PdoMethods();

    // Split the full name into first and last names
    $parts = explode(" ", $name, 2); 
    $firstName = $parts[0];
    $lastName = $parts[1]; 

    // Format the name as "Last, First"
    $nameFormatted = $lastName . ", " . $firstName;

    // Insert the formatted name into the database
    $sql = "INSERT INTO names (name) VALUES (:name)";
    $bindings = [
        [':name', $nameFormatted, 'str'],
    ];

    $result = $pdo->otherBinded($sql, $bindings);

    // Check result and respond accordingly
    if ($result === "error") {
        $response = (object)[
            'masterstatus' => "error",
            'msg' => "There was an error entering the name"
        ];
    } else {
        $response = (object)[
            'masterstatus' => 'success',
            'msg' => "Name has been added"
        ];
    }
} 

// Output the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>