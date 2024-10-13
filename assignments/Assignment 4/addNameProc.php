<?php
    class AddNamesProc{

        private $namesList = array(); //Declaration of blank array

        public function __construct() {
            if (isset($_POST['namesListHidden']) && !empty($_POST['namesListHidden'])) { //Brings in old names
                $this->namesList = explode("\n", $_POST['namesListHidden']); //Seperates them into Strings and puts them into the array, breaking on the "\n" since it's the last part of the String, and also the ","s are used in the Strings
            }
        }

        public function addName(){
            if (isset($_POST["newName"]) && !empty($_POST["newName"])) {
                $inputName = $_POST["newName"];
                $parts = explode(" ", $inputName); //Breaks new name on the " "
                $firstName = $parts[0];
                $lastName = $parts[1]; //Assigns to firstName and lastName
                $formattedName = $lastName . ", " . $firstName . "\n"; //Formats String for output
                array_push($this->namesList, $formattedName); //Puts formatted String into the array
            };
        }

        public function addClearNames(){
            if (isset($_POST["addNameButton"])) {
                $this->addName();
                sort($this->namesList);
                $outputString = "";
                if ($this->namesList != null){ //Makes sure there are present names
                foreach($this->namesList as $i){
                    $outputString .= "$i";
                } } //Builds full list of names to output
                return $outputString;
            } elseif (isset($_POST["clearNamesButton"])) {
                $this->namesList = array();
                return ""; //Resets array to blank
            }
        }

    }

?>