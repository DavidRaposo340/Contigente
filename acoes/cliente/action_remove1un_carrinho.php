<?php
    $path2root = "../../";

    session_start();
    include_once "../../includes/opendb.php";
    include_once "../../database/shopping_cart.php";

    $id = $_GET['id'];
    $quant = 1;
    
    //remove...
    header("Location: ".$path2root."paginas_form/cliente/listar_carrinho.php");
?>