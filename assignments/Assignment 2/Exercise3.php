<?php
$num1 = 15;
$num2 = 5;
$output = <<<STR
<table border = "1">
STR;

for ($i=1; $i<=$num1; $i++){
    $output .= "<tr>";
    for ($j=1; $j<=$num2; $j++){
        $output .= "<td>Row $i Cell $j</td>";
       }
    $output .= "</tr>";
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise 3</title>
</head>
<body>
    <?php echo $output; ?>

</body>
</html>