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


    //verificaçao de stock
    //check_stock-> 0 se nao tem stock (de qualquer prod), 1 se tem 
    $list_carrinho = getShoppingCartbyUserID($id_user);
    $row = pg_fetch_assoc($list_carrinho);

    $check_stock=1;
    while (isset($row['id_prod'])) {
        $stock = getQuantityofProductbyID($row['id_prod']);
        if($row['quant'] > $stock)
            $check_stock=0;

        $row = pg_fetch_assoc($list_carrinho);
    }

    //create order & order_lines
    if($check_stock){
        $t=time();
        createOrder($id_user,date("Y-m-d",$t));

        $order_id=getLastOrderIDbyUser($id_user);
        
        $list_carrinho = getShoppingCartbyUserID($id_user);
        $row = pg_fetch_assoc($list_carrinho);

        //verificaçao de restriçoes alimentares do user
        $r_user=getRestrictionsofUser($id_user);
        $user_restr = pg_fetch_assoc($r_user);	
        
        while (isset($row['id_prod'])) {
            insertinOrderLines($order_id, $row['id_prod'], $row['quant']);

            //ajuste de stock
            $stock = getQuantityofProductbyID($row['id_prod']);
            updateQuantityofProduct($row['id_prod'], $stock-$row['quant']);
            
                //verificaçao de restriçoes alimentares 
                $prod_restr=getBoolRestrictionsofProductbyID($row['id_prod']);
                echo $user_restr['no_gluten'];
                echo $prod_restr['no_gluten'];
                if( $user_restr['no_gluten']!=$prod_restr['no_gluten'] ||
                    $user_restr['no_lacti']!=$prod_restr['no_lactose'] ||
                    $user_restr['vegan']!=$prod_restr['vegan']){
                        $_SESSION['msgErro'] = "Cuidado!! O(s) produto(s) que selecionou contêm as suas restrições alimentares"; 
                    }

            $row = pg_fetch_assoc($list_carrinho);
        }

        updateStateofOrder($order_id, "Por Pagar", date("Y-m-d",$t));
        setPriceofOrder($order_id);
        deleteShoppingCart($id_user);

        header("Location: ".$path2root."paginas_form/cliente/listar_finalizar_encomenda.php?id=$order_id");

    }
    else{
        deleteShoppingCart($id_user);
       
        header("Location: ".$path2root."paginas_form/cliente/listar_carrinho.php");
    }
    
?>