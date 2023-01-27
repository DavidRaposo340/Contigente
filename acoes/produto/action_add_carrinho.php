<?php
    $path2root = "../../";

    session_start();
    include_once "../../includes/opendb.php";
    include_once "../../database/shopping_cart.php";

    $id = $_GET['id'];
    $quant = $_GET["quantity"];

    if (!empty($_SESSION['user']))
        insertinShoppingCart($_SESSION['user'], $id, $quant);
    header("Location: ".$path2root."paginas_form/produto/listar_loja_produtos.php");
?>