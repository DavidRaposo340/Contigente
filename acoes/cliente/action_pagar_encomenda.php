<?php
    $path2root = "../../";

    session_start();
    include_once "../../includes/opendb.php";
    include_once "../../database/shopping_cart.php";
    include_once "../../database/orders.php";
    

    $id_order = $_GET['id'];
    $t=time();
    updateStateofOrder($id_order, "Pago", date("Y-m-d",$t));

    header("Location: ".$path2root."paginas_form/cliente/listar_encomendas.php");
?>