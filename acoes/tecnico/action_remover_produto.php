<?php
    $path2root = "../../";

    session_start();
    include_once "../../includes/opendb.php";
    include_once "../../database/products.php";

    $id = $_GET['id'];

    deleteProduct($id);
       
    header("Location: ".$path2root."paginas_form/tecnico/listar_produtos.php");
?>