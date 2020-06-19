<?php
    $database_connection = null;
    function get_connection(){
        $hostname = "localhost";
        $database = "bookborrowdb";
        $username = "root";
        $password = "root";
        global $database_connection;
        $database_connection = @mysqli_connect($hostname, $username, $password, $database) or die(mysqli_error($database_connection));
        mysqli_query($database_connection,"set names 'utf8'");
        @mysqli_select_db($database_connection,$database) or die(mysqli_error($database_connection));
    }
    function close_connection(){
        global $database_connection;
        if($database_connection){
            mysqli_close($database_connection) or die (mysqli_error($database_connection));
        }
    }
    ?>