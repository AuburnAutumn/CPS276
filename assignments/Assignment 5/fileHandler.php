<?php
    class fileHandler{

        private $directoryName = "";
        private $body = "";

        public function createFile(){

            if (isset($_POST["folderNameInput"]) && isset($_POST["fileContentsInput"])) {
                $this->directoryName = $_POST["folderNameInput"];
                $this->body = $_POST["fileContentsInput"];

                $newDirectory = "assignments/Assignment 5/directories/" . $this->directoryName;

                mkdir($newDirectory);
                chmod($newDirectory, 0777);

                touch($newDirectory . "/readme.txt");
                $handle = fopen($newDirectory)."/readme.txt";
                fwrite($handle, $this->body);
                fclose($handle);
                

            return $this -> directoryName . " " . $this -> body; 
            } 
        }


    }

?>