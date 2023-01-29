<!DOCTYPE html>
<html>
<meta charset="UTF-8">

<head>
    <title>Encomendas</title>
    <link rel="stylesheet" href="../../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
        $path2root = "../../";
        include("../../includes/navbar.php"); 
        include_once "../../includes/opendb.php";
        include_once "../../database/order_lines.php";
        include_once "../../database/orders.php";
        include_once "../../database/products.php";
        include_once "../../database/users.php";

        if(empty($_SESSION['user']))
            header("Location: ".$path2root."index.php");
    
    ?>  
    <div class="flex-box-encomendas">
        <h2> Lista de Encomendas: </h2>

        <?php	

            echo"<div class=\"table_style\">";
            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th><th>Cliente</th><th>Data</th><th>Estado</th><th>Produtos</th><th>Preço Total</th><th>Processo</th>";
            echo "</tr>";	
            
            $user=$_SESSION['user'];

            $list_orders = getAllOrdersofUserbyID($user); //TODO #66 Alterar para user da variavel de sessao
            $row = pg_fetch_assoc($list_orders);

            $user_name = getNamebyUserID($user);

            while (isset($row['id'])) {

                $lists_prodocts=getProductsandQuantityofOrder($row['id']);
                $row_products = pg_fetch_assoc($lists_prodocts);
                $order_date = getdateofOrder($row['id']);

                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$user_name."</td>";
                echo "<td style='width:90px;padding:0px'>".$order_date."</td>"; 
                echo "<td>".$row['state']."</td>";
                echo "<td>";
                while (isset($row_products['id_product'])) {
                    $products_name=getProductByID($row_products['id_product']);
                    $products_thing = pg_fetch_row($products_name,0);
                    echo "<p>".$products_thing[5]."</p>";
                    $row_products = pg_fetch_assoc($lists_prodocts);
                }
                echo"</td>";
                echo "<td>".$row['total_price']." €</td>";
                echo "<td> <a href=\"".$path2root."acoes/cliente/action_pagar_encomenda.php?id=".$row['id']."\"> Pagar </td>"; //TODO #68 Action para efetuar pagamento
                echo "</tr>";
                $row = pg_fetch_assoc($list_orders);
            }
            echo "</table>";
            echo "</div>";
        ?>
    </div>
</body>

</html>