<?php
    $path2root = "../../";

    session_start();
    include_once "../../includes/opendb.php";
    include_once "../../database/shopping_cart.php";

    $id = $_GET['id'];
    echo $id;
    echo $_SESSION['user'];

    insertinShoppingCart($_SESSION['user'], $id, 1);
    header("Location: ".$path2root."paginas_form/produto/listar_loja_produtos.php");

    
?>