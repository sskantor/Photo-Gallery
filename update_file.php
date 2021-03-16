<?php

    if(isset($_GET["old_name"]) && isset($_GET["new_name"]) && isset($_GET["directory"]) && isset($_GET["extension"])){
        $old_name = $_GET["old_name"];
        $new_name = $_GET["new_name"];

        $directory = $_GET["directory"];
        $directory = trim($directory, " ");

        $extension = $_GET["extension"];
        $extension = trim($extension, " ");

        $fullpath = '/home/s35/public_html/';
        $dot = ".";

        $slash = "/";

        //adding name and the extension
        $full_oldname = $directory. $slash .$old_name. $dot .$extension;
        $full_newname = $directory . $slash . $new_name . $dot . $extension;
        
        //renaming file
        echo rename($fullpath.$full_oldname, $fullpath.$full_newname);      
    }

?>