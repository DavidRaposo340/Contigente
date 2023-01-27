<!DOCTYPE html>
<html>
<meta charset="UTF-8">

<head>
    <title>Encomendas</title>
    <!-- PARA DOUBLE RANGE SLIDER - elementos que nao aplico css ficam com estilo importado...
        <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
        <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    -->

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
    
    
    ?>  
    <div class="flex-box-encomendas">
        <h2> Lista de Encomendas: </h2>

        <?php	
        echo"<div class=\"table_style\">";
        echo "<table>";
    
            echo "<tr>";
            echo "<th>ID</th><th>Cliente</th><th>Data</th><th>Estado</th><th>Produtos</th><th>Preço Total</th><th>Processo</th>";
            echo "</tr>";	
                    
            $list_orders = getAllOrdersofUserbyID(3);
            


            $row = pg_fetch_assoc($list_orders);

            while (isset($row['id'])) {
                $list_orders=getProductsandQuantityofOrder($row['id']);
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>cliente</td>"; //getClienteNamebyUserID()
                echo "<td>date</td>";   //getDatebyOrderID()
                echo "<td>".$row['state']."</td>";
                echo "<td>produtos</td>"; //getProductsByorderID
                echo "<td>".$row['total_price']."</td>";
                echo "<td>button</td>";
                /*echo "<td>".$row['id_produtos_name']."</td>";
                echo "<td>".$row['total_price']."</td>";
                echo "<button onclick=\"location.href='".$path2root."acoes/cliente/CRIARACAO.php?id=".$row['id']."';\"> Ver detalhes</button>";*/
                echo "</tr>";

                $row = pg_fetch_assoc($list_orders);
            }

            echo "</table>";
            echo "</div>";
        ?>
    </div>
</body>

</html>