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
          
        if(empty($_SESSION['user']))
            header("Location: ".$path2root."index.php");

        $list_carrinho = getShoppingCartbyUserID($_SESSION['user']);
        $total_price_shop_cart = getTotalPriceofShoppingCartofUser($_SESSION['user']);
        
    ?>
    
    <div class="flex-box-generic">
        <h2> Finalizar encomenda: </h2>
        <p>
            Antes de confirmar a encomenda, 
            verifique se as quantidade e os valores estão corretos.<br>
            Não poderá voltar a trás.
        </p>
        <div class="generic_table_style">
            <table>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço Total</th>
                </tr>
                <?php
                
                    $row = pg_fetch_assoc($list_carrinho);

                    while (isset($row['id'])) {

                        echo "<tr>";
                        echo "<td> <a href=\"".$path2root."paginas_form/produto/listar_produto_info.php?id=".$row['id_prod']."\"> ".$row['name']."</td>";
                        echo "<td>".$row['quant']." Unidade(s) </td>";
                        $total_price=getTotalPriceProductbyQuantity($row['id_prod'], $row['quant']); 
                        echo "<td> ".$total_price." € </td>";
                        echo "</tr>";
                                
                        $row = pg_fetch_assoc($list_carrinho);
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
        <button class="confirm_button" onclick="location.href=" "> Pagar Encomenda </button>
        <button class="cancel_button" onclick="location.href=" "> Cancelar Encomenda </button>
               
      
    </div>


    

    

</body>

</html>
