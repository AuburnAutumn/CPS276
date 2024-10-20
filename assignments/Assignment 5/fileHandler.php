<?php
    class fileHandler{

        private $directoryName = "";
        private $body = "";

        public function createFile(){

            //Grabbing strings from the inputs
            if (isset($_POST["folderNameInput"]) && isset($_POST["fileContentsInput"])) {
                $this->directoryName = $_POST["folderNameInput"];
                $this->body = $_POST["fileContentsInput"];

                //Creates String for new directory
                $newDirectory = "directories/" . $this->directoryName;

                //Checks to see if it already exists
                if (is_dir($newDirectory)){
                    return "A directory already exists with that name";

                } else {

            //Goes through creating new directory
            //@'s to stop the website from throwing errors, leaving only the custom errors
            //This one creates the directory
            if (!@mkdir($newDirectory, 0777)) {
                return "Error: Failed to create directory.";
            }

            //creates readme.txt file
            if (!@touch($newDirectory . "/readme.txt")) {
                return "Error: Failed to create file in the directory.";
            }

            //Opens the file for writing (and reading)
            $handle = @fopen($newDirectory . "/readme.txt", "r+");
            if ($handle === false) {
                return "Error: Failed to open file for writing.";
            }

            //Writes body to file
            if (fwrite($handle, $this->body) === false) {
                fclose($handle);
                return "Error: Failed to write to the file.";
            }

            //Creates formatted string to return the link
            $directoryUrl = "/~abonk/assignments/Assignment%205/" . $newDirectory . "/readme.txt";  //Corrects formatting

            //Return String with target _blank link included
                return "File and directory were created.<br><br>" .
                   "<a href='" . $directoryUrl . "' target=\"_blank\">Path where file is located</a>" ;
                
                }
            } 
        }

    }

?>