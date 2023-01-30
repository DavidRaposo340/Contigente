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


    ?>
    <div class="flex-box-encomendas">
        <h2> Lista de Encomendas: </h2>

        <?php
        echo "<div class=\"table_style\">";
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th><th>Cliente</th><th>Data</th><th>Estado</th><th>Produtos</th><th>Preço Total</th><th>Processo</th>";
        echo "</tr>";

        $list_orders = getAllOrders();
        $row = pg_fetch_assoc($list_orders);

        while (isset($row['id'])) {

            $lists_prodocts = getProductsandQuantityofOrder($row['id']);
            $row_products = pg_fetch_assoc($lists_prodocts);

            $order_date = getdateofOrder($row['id']);
            $user_name = getNamebyUserID($row['user_id']);

            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $user_name . "</td>";
            echo "<td style='width:90px;padding:0px'>" . $order_date . "</td>";
            echo "<td>" . $row['state'] . "</td>";
            echo "<td>";
            while (isset($row_products['id_product'])) {
                $products_name = getProductByID($row_products['id_product']);
                $products_thing = pg_fetch_row($products_name, 0);
                echo "<p>" . $products_thing[5] . "</p>";
                $row_products = pg_fetch_assoc($lists_prodocts);
            }
            echo "</td>";
            echo "<td>" . $row['total_price'] . " €</td>";
            if($row['state']=="Entregue"){
                echo "<td></td>";
            }
            else echo "<td> <a href=\"".$path2root."acoes/tecnico/action_enviar_encomenda.php?id=".$row['id']."\"> Enviar </td>"; //TODO #68 Action para efetuar pagamento
            echo "</tr>";
            $row = pg_fetch_assoc($list_orders);
        }
        echo "</table>";
        echo "</div>";
        ?>
    </div>
</body>

</html>