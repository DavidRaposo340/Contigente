<?php
    $path2root = "../../";

    session_start();
    include_once "../../includes/opendb.php";
    include_once "../../database/users.php";
    
    deleteUser($_SESSION['user']);
    $_SESSION['user']=NULL;
    header("Location: ".$path2root."index.php");
?>