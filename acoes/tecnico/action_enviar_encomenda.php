<?php
    $path2root = "../../";

    session_start();
    include_once "../../includes/opendb.php";
    include_once "../../database/shopping_cart.php";
    include_once "../../database/products.php";
    include_once "../../database/recipes.php";  
    include_once "../../database/orders.php";  
    include_once "../../database/order_lines.php";
    include_once "../../database/users.php";
    

    $id_user = $_GET['id'];
    $t=time();
    updateStateofOrder($id_user, "Entregue", date("Y-m-d",$t));

    header("Location: ".$path2root."paginas_form/tecnico/listar_encomendas_tecnico.php");
    
?>