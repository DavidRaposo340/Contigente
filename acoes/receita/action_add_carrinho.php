<?php
    $path2root = "../../";

    session_start();
    include_once "../../includes/opendb.php";
    include_once "../../database/shopping_cart.php";
    include_once "../../database/recipes.php";  

    $id = $_GET['id'];

    $user=$_SESSION['user'];
    if (empty($user)) {
        $_SESSION['msgErro'] = "Para adicionar produtos ao carrinho deve iniciar sessão ";     
        header("Location: ".$path2root."paginas_form/geral/form_login.php");
    }
    else{
        $list_prods=getProductsandQuantityofRecipe($id);
        $row_prod = pg_fetch_assoc($list_prods);
        
    
        while (isset($row_prod['id_products'])) {
            insertinShoppingCart($_SESSION['user'], $row_prod['id_products'], $row_prod['quantity']);
            $row_prod = pg_fetch_assoc($list_prods);
        }
        header("Location: ".$path2root."paginas_form/cliente/listar_carrinho.php");
    }



    
?>