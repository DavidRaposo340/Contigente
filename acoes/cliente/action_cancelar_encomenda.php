<?php
    $path2root = "../../";

    session_start();
    include_once "../../includes/opendb.php";
    include_once "../../database/shopping_cart.php";
    include_once "../../database/orders.php";
    include_once "../../database/products.php";
    include_once "../../database/order_lines.php";
    

    $id_order = $_GET['id'];
    
    $t=time();
    updateStateofOrder($id_order, "Cancelada", date("Y-m-d",$t));

    $list_encomenda = getProductsandQuantityofOrder($id_order);
    $row = pg_fetch_assoc($list_encomenda);

    while (isset($row['id_product'])) {

        //ajuste de stock
        $stock = getQuantityofProductbyID($row['id_product']);
        updateQuantityofProduct($row['id_product'], $stock+$row['quant']);   
        $row = pg_fetch_assoc($list_encomenda);
    }

    $_SESSION['msgErro'] = "Cancelou a sua encomenda, todo o stock que tinha sido reservado para si foi reposto!"; 
    header("Location: ".$path2root."paginas_form/cliente/listar_carrinho.php");

?>