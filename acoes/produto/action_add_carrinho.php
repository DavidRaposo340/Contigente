<?php
    $path2root = "../../";

    session_start();
    include_once "../../includes/opendb.php";
    include_once "../../database/shopping_cart.php";

    $id = $_GET['id'];
    $quant = $_GET["quantity"];

    if (empty($_SESSION['user'])) {
        $_SESSION['msgErro'] = "Para adicionar produtos ao carrinho deve iniciar sessão ";     
        header("Location: ".$path2root."paginas_form/geral/form_login.php");
    }
    else{
        insertinShoppingCart($_SESSION['user'], $id, $quant);
        $_SESSION['msgAviso'] = "Adicionou produto(s) ao carrinho";     

        header("Location: ".$path2root."paginas_form/produto/listar_loja_produtos.php");
    }
       
?>