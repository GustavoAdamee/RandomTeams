<?php

    if($_SESSION['logged_in'] != true) {
        die("<script>window.location.href='../index.php';</script>");
    }

?>