<!DOCTYPE html>
<html>
<meta charset="UTF-8">

<head>
    <title>Loja De Produtos</title>
        <!-- PARA ICONS-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
        $path2root = "../../";
        include("../../includes/navbar.php"); 
        include_once "../../includes/opendb.php";
        include_once "../../database/shopping_cart.php";    
        include_once "../../database/products.php";        
        include_once "../../database/recipes.php";  
        include_once "../../database/orders.php";   
        include_once "../../database/order_lines.php";  
        
          
        if(empty($_SESSION['user']))
            header("Location: ".$path2root."index.php");
            echo  "<br>";
            echo  "<br>";
            echo  "<br>";
            echo  "<br>";
          
        $id_order = $_GET['id'];

        $total_price_shop_cart = getPriceofOrder($id_order);
        $list_encomenda = getProductsandQuantityofOrder($id_order);
        
    ?>
    
    <div class="flex-box-generic">
        <h2> Finalizar encomenda: </h2>
        <p>
            Já verificamos o nosso stock e reservamos as quantidades que reservou.<br><br>
            Assim que pagar, não precisa de fazer mais nada!<br><br>
            Antes de confirmar e pagar a encomenda, 
            verifique se as quantidade e os valores estão corretos.           
            Não poderá voltar a trás.
        </p>
        <?php
            if (!empty($_SESSION['msgErro'])) {
                echo "<p style=\"color:red\">" . $_SESSION['msgErro'] . "</p>";
                $_SESSION['msgErro'] = NULL;
            }
        ?>
        <div class="generic_table_style">
            <table>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço Total</th>
                </tr>
                <?php
                
                    $row = pg_fetch_assoc($list_encomenda);

                    while (isset($row['id_product'])) {

                        echo "<tr>";
                        echo "<td> <a href=\"".$path2root."paginas_form/produto/listar_produto_info.php?id=".$row['id_product']."\"> ".$row['name']."</td>";
                        echo "<td>".$row['quant']." Unidade(s) </td>";
                        $total_price=getTotalPriceProductbyQuantity($row['id_product'], $row['quant']); 
                        echo "<td> ".$total_price." € </td>";
                        echo "</tr>";
                             
                        $row = pg_fetch_assoc($list_encomenda);
                    }
                    
                ?>
            </table>
        </div>
        <div class="mini-table_style">
            <table>
                <tr>
                    <th>Total a pagar</th>
                    <td><?php echo $total_price_shop_cart ?> € </td>
                </tr>
            </table>
        </div>
        <br>           
        <button class="confirm_button" onclick="location.href='<?php echo $path2root ?>acoes/cliente/action_pagar_encomenda.php?id=<?php echo $id_order ?>' "> Pagar Encomenda </button>
        <button class="cancel_button" onclick="location.href='<?php echo $path2root ?>acoes/cliente/action_cancelar_encomenda.php?id=<?php echo $id_order ?>' "> Cancelar Encomenda </button>
               
      
    </div>


    

    

</body>

</html>
