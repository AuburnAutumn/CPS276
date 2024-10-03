<?php
class Calculator{

    /*Function to return the error, keeping this String seperate from the other function just makes my
    code less cluttered-looking, also made it easier for me to move things around while coding*/
    function _sendError(){
        return "Cannot perform operation. You must have three arguments. A string for the operator
        (+,-,*,/) and two integers or floats for the numbers <br><br>";
    }

    public function calc($op = "invalid", $num1 = "invalid", $num2 = "invalid") { //Default parameters in case of too few being passed in
    if (!in_array($op, ["+", "-", "*", "/"])| !is_numeric($num1) | !is_numeric($num2)) { //Checks to make sure all the data types are correct and that the operator is valid
        return $this->_sendError();
         } else {
            $answer = "The calculation is {$num1} {$op} {$num2}. "; //All return Strings begin the same way, so I initilize it like this outside the switch statement.
        switch ($op){
            case "+": 
                $result = $num1 + $num2; 
                return $answer." The answer is {$result}. <br><br>"; //The second half is built in the switch statement. This is because I prefer returning "Cannot divide by 0" instead of "The answer is cannot divide by 0", and this makes it possible. That's not what was in the example, though. 
            case "-":
                $result = $num1 - $num2;
                return $answer." The answer is {$result}. <br><br>";
            case "*":
                $result = $num1 * $num2;
                return $answer." The answer is {$result}. <br><br>";
            case "/":
            if ($num2 == 0){ //Checks if trying to divide by 0
                return $answer."  The answer is cannot divide a number by zero. <br><br>";   
            } else {
                $result = $num1 / $num2;
                return $answer." The answer is {$result}. <br><br>";
;
            }
            default: return $this->_sendError(); //Code should never reach this because it won't let anything but the four operaters through, but I'm keeping just in case. 
            }
        }
    }
}
  ?>

