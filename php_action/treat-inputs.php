<?php

    include_once "db-connect.php";

    function clearInput($data) {

        global $connect;

        $data = mysqli_escape_string($connect, $data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>