<?php
    $path2root = "../../";

    session_start();
    include_once "../../includes/opendb.php";
    include_once "../../database/shopping_cart.php";
    include_once "../../database/recipes.php";  

    $id = $_GET['id'];
    echo $id;
    echo $_SESSION['user'];

    $list_prods=getProductsandQuantityofRecipe($id);
    $row_prod = pg_fetch_assoc($list_prods);
    

    while (isset($row_prod['id_products'])) {
        insertinShoppingCart($_SESSION['user'], $row_prod['id_products'], $row_prod['quantity']);
        $row_prod = pg_fetch_assoc($list_prods);
    }
    header("Location: ".$path2root."paginas_form/cliente/listar_carrinho.php");

    
?>